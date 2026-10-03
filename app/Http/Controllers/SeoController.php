<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Category;
use App\Models\Article;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $products = Product::active()->latest()->get();
        $categories = Category::where('is_active', true)->get();
        $articles = Article::where('is_published', true)->latest()->get();

        $content = view('seo.sitemap', compact('products', 'categories', 'articles'))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function robots(): Response
    {
        $appUrl = config('app.url', url('/'));
        $content = "User-agent: *\n" .
                   "Allow: /\n" .
                   "Disallow: /admin/\n" .
                   "Disallow: /mi-cuenta/\n" .
                   "Disallow: /checkout/\n\n" .
                   "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
