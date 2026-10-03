<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SearchLog;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['images', 'brand', 'category'])->active();

        // Search Keyword
        if ($search = $request->input('buscar')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('meta_keywords', 'like', "%{$search}%");
            });

            // Log search for admin analytics
            $resultsCount = (clone $query)->count();
            SearchLog::create([
                'query' => trim($search),
                'user_id' => Auth::id(),
                'ip_address' => $request->ip(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 255),
                'city' => 'Lima', // In production can use GeoIP
                'country' => 'Perú',
                'results_count' => $resultsCount,
                'created_at' => now(),
            ]);
        }

        // Category Filter
        if ($catSlug = $request->input('categoria')) {
            $cat = Category::where('slug', $catSlug)->first();
            if ($cat) {
                $catIds = [$cat->id];
                if ($cat->children()->count() > 0) {
                    $catIds = array_merge($catIds, $cat->children()->pluck('id')->toArray());
                }
                $query->whereIn('category_id', $catIds);
            }
        }

        // Brand Filter
        if ($brandSlug = $request->input('marca')) {
            $query->whereHas('brand', function ($q) use ($brandSlug) {
                $q->where('slug', $brandSlug);
            });
        }

        // Featured Filter
        if ($request->has('destacados')) {
            $query->where('is_featured', true);
        }

        // Price Filter
        if ($minPrice = $request->input('precio_min')) {
            $query->where('price', '>=', (float)$minPrice);
        }
        if ($maxPrice = $request->input('precio_max')) {
            $query->where('price', '<=', (float)$maxPrice);
        }

        // Sorting
        $sort = $request->input('orden', 'recientes');
        match ($sort) {
            'precio_bajo' => $query->orderBy('price', 'asc'),
            'precio_alto' => $query->orderBy('price', 'desc'),
            'nombre_asc' => $query->orderBy('name', 'asc'),
            'nombre_desc' => $query->orderBy('name', 'desc'),
            'populares' => $query->orderBy('views_count', 'desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(9)->withQueryString();

        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function ($q) {
                $q->where('is_active', true)->withCount('products');
            }])
            ->withCount('products')
            ->get();

        $brands = Brand::where('is_active', true)->withCount('products')->get();

        return view('frontend.products.index', compact('products', 'categories', 'brands'));
    }

    public function show(string $slug)
    {
        $product = Product::with(['images', 'brand', 'category'])->where('slug', $slug)->firstOrFail();

        // Increment views
        $product->increment('views_count');

        $relatedProducts = Product::with(['images', 'brand', 'category'])
            ->active()
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category_id', $product->category_id)
                  ->orWhere('brand_id', $product->brand_id);
            })
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }

    public function destacados()
    {
        $products = Product::with(['images', 'brand', 'category'])
            ->active()
            ->featured()
            ->latest()
            ->paginate(12);

        return view('frontend.products.destacados', compact('products'));
    }

    public function searchSuggest(Request $request)
    {
        $q = trim($request->input('q'));
        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $results = Product::active()
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('sku', 'like', "%{$q}%");
            })
            ->take(6)
            ->get(['id', 'name', 'slug', 'sku', 'price', 'show_price'])
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'sku' => $p->sku,
                    'url' => route('products.show', $p->slug),
                    'image' => $p->main_image_url,
                    'price' => $p->show_price ? number_format($p->effective_price, 2) : 'Consultar',
                ];
            });

        return response()->json($results);
    }
}
