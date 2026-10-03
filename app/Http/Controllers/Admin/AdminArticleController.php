<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $filename = 'art_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/banners'), $filename);
            $validated['image_path'] = 'uploads/banners/' . $filename;
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artículo publicado con éxito.');
    }

    public function edit(int $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, int $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $filename = 'art_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/banners'), $filename);
            $validated['image_path'] = 'uploads/banners/' . $filename;
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artículo actualizado.');
    }

    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artículo eliminado.');
    }
}
