<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Str;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:80',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $filename = 'slider_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/sliders'), $filename);
            $validated['image_path'] = 'uploads/sliders/' . $filename;
        }

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider creado exitosamente.');
    }

    public function edit(int $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, int $id)
    {
        $slider = Slider::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:80',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $filename = 'slider_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/sliders'), $filename);
            $validated['image_path'] = 'uploads/sliders/' . $filename;
        }

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider actualizado.');
    }

    public function destroy(int $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider eliminado.');
    }
}
