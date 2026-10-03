<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Article;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order')->get();
        
        $featuredProducts = Product::with(['images', 'brand', 'category'])
            ->active()
            ->featured()
            ->latest()
            ->take(8)
            ->get();

        $electricVehicles = Product::with(['images', 'brand', 'category'])
            ->active()
            ->whereHas('category', function ($q) {
                $q->where('slug', 'vehiculos-electricos')
                  ->orWhereHas('parent', function ($p) {
                      $p->where('slug', 'vehiculos-electricos');
                  });
            })
            ->latest()
            ->take(6)
            ->get();

        $roadImplements = Product::with(['images', 'brand', 'category'])
            ->active()
            ->whereHas('category', function ($q) {
                $q->where('slug', 'implementos-rodoviarios')
                  ->orWhereHas('parent', function ($p) {
                      $p->where('slug', 'implementos-rodoviarios');
                  });
            })
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function ($q) {
                $q->where('is_active', true)->withCount('products');
            }])
            ->withCount('products')
            ->orderBy('order')
            ->get();

        $brands = Brand::where('is_active', true)->orderBy('order')->get();

        $middleBanners = Banner::where('is_active', true)
            ->where('type', 'middle')
            ->orderBy('order')
            ->get();

        $popupBanner = Banner::where('is_active', true)
            ->where('type', 'popup')
            ->first();

        $recentArticles = Article::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.home', compact(
            'sliders',
            'featuredProducts',
            'electricVehicles',
            'roadImplements',
            'categories',
            'brands',
            'middleBanners',
            'popupBanner',
            'recentArticles'
        ));
    }
}
