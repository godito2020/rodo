<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;

class AdminBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->orderBy('order')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'website' => 'nullable|url|max:200',
            'description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            $filename = 'brand_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('uploads/brands'), $filename);
            $validated['logo'] = 'uploads/brands/' . $filename;
        }

        Brand::create($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Marca creada exitosamente.');
    }

    public function edit(int $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, int $id)
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'website' => 'nullable|url|max:200',
            'description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            $filename = 'brand_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('uploads/brands'), $filename);
            $validated['logo'] = 'uploads/brands/' . $filename;
        }

        $brand->update($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Marca actualizada.');
    }

    public function destroy(int $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Marca eliminada.');
    }
}
