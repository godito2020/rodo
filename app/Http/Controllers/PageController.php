<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ContactInquiry;
use App\Models\Brand;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function empresa()
    {
        $brands = Brand::where('is_active', true)->get();
        return view('frontend.pages.empresa', compact('brands'));
    }

    public function novedades()
    {
        $articles = Article::where('is_published', true)->latest()->paginate(6);
        $recentArticles = Article::where('is_published', true)->latest()->take(4)->get();
        return view('frontend.pages.novedades', compact('articles', 'recentArticles'));
    }

    public function novedadShow(string $slug)
    {
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $article->increment('views_count');

        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        return view('frontend.pages.novedad_detail', compact('article', 'relatedArticles'));
    }

    public function contacto(Request $request)
    {
        $productInterest = $request->query('producto', '');
        return view('frontend.pages.contacto', compact('productInterest'));
    }

    public function submitContacto(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:150',
            'product_interest' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        ContactInquiry::create($validated);

        return back()->with('success', '¡Gracias por contactarnos! Un asesor especializado de RODOPERU se comunicará contigo a la brevedad.');
    }
}
