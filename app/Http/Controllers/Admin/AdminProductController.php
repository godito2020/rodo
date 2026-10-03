<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'primaryImage']);

        if ($search = $request->input('buscar')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($catId = $request->input('categoria_id')) {
            $query->where('category_id', $catId);
        }

        if ($brandId = $request->input('brand_id')) {
            $query->where('brand_id', $brandId);
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();

        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'sku' => 'nullable|string|max:50|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'action_type' => 'required|in:buy,whatsapp,both',
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:300',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$originalSlug}-{$count}";
            $count++;
        }

        $validated['show_price'] = $request->has('show_price');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Parse technical specs
        $specsKeys = $request->input('spec_key', []);
        $specsValues = $request->input('spec_val', []);
        $specs = [];
        for ($i = 0; $i < count($specsKeys); $i++) {
            if (!empty($specsKeys[$i]) && !empty($specsValues[$i])) {
                $specs[] = [
                    'key' => trim($specsKeys[$i]),
                    'value' => trim($specsValues[$i]),
                ];
            }
        }
        $validated['technical_specs'] = $specs;

        $product = Product::create($validated);

        // Upload images
        if ($request->hasFile('images')) {
            $isFirst = true;
            foreach ($request->file('images') as $file) {
                $filename = 'prod_' . $product->id . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/products/' . $filename,
                    'is_primary' => $isFirst,
                    'order' => $isFirst ? 1 : 2,
                ]);
                $isFirst = false;
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(int $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'sku' => 'nullable|string|max:50|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'action_type' => 'required|in:buy,whatsapp,both',
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:300',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ]);

        $validated['show_price'] = $request->has('show_price');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Parse technical specs
        $specsKeys = $request->input('spec_key', []);
        $specsValues = $request->input('spec_val', []);
        $specs = [];
        for ($i = 0; $i < count($specsKeys); $i++) {
            if (!empty($specsKeys[$i]) && !empty($specsValues[$i])) {
                $specs[] = [
                    'key' => trim($specsKeys[$i]),
                    'value' => trim($specsValues[$i]),
                ];
            }
        }
        $validated['technical_specs'] = $specs;

        $product->update($validated);

        // Upload new images
        if ($request->hasFile('images')) {
            $hasPrimary = $product->images()->where('is_primary', true)->exists();
            foreach ($request->file('images') as $file) {
                $filename = 'prod_' . $product->id . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/products/' . $filename,
                    'is_primary' => !$hasPrimary,
                    'order' => 10,
                ]);
                $hasPrimary = true;
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado exitosamente.');
    }

    public function togglePrice(int $id)
    {
        $product = Product::findOrFail($id);
        $product->update(['show_price' => !$product->show_price]);

        return back()->with('success', 'Visibilidad de precio actualizada.');
    }

    public function toggleStatus(int $id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_active' => !$product->is_active]);

        return back()->with('success', 'Estado del producto actualizado.');
    }

    public function deleteImage(int $imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        $productId = $image->product_id;
        $image->delete();

        // If it was primary, make next one primary
        $next = ProductImage::where('product_id', $productId)->first();
        if ($next) {
            $next->update(['is_primary' => true]);
        }

        return back()->with('success', 'Imagen eliminada correctamente.');
    }

    public function setPrimaryImage(int $imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        ProductImage::where('product_id', $image->product_id)->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Imagen principal establecida.');
    }
}
