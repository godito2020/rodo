<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Setting;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('type')->orderBy('order')->get();
        $popupActive = Setting::get('popup_active', '1') == '1';
        $popupTitle = Setting::get('popup_title', '');
        $popupSubtitle = Setting::get('popup_subtitle', '');
        $popupButtonText = Setting::get('popup_button_text', '');
        $popupButtonUrl = Setting::get('popup_button_url', '');
        $popupCountdown = Setting::get('popup_countdown', '');

        return view('admin.banners.index', compact(
            'banners',
            'popupActive',
            'popupTitle',
            'popupSubtitle',
            'popupButtonText',
            'popupButtonUrl',
            'popupCountdown'
        ));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|in:middle,hero_side,popup,footer',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string|max:255',
            'countdown_date' => 'nullable|date',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $filename = 'banner_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/banners'), $filename);
            $validated['image_path'] = 'uploads/banners/' . $filename;
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner creado exitosamente.');
    }

    public function edit(int $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, int $id)
    {
        $banner = Banner::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|in:middle,hero_side,popup,footer',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string|max:255',
            'countdown_date' => 'nullable|date',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $filename = 'banner_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/banners'), $filename);
            $validated['image_path'] = 'uploads/banners/' . $filename;
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner modificado.');
    }

    public function destroy(int $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner eliminado.');
    }

    public function updatePopup(Request $request)
    {
        Setting::set('popup_active', $request->has('popup_active') ? '1' : '0', 'popup');
        Setting::set('popup_title', $request->input('popup_title', ''), 'popup');
        Setting::set('popup_subtitle', $request->input('popup_subtitle', ''), 'popup');
        Setting::set('popup_button_text', $request->input('popup_button_text', ''), 'popup');
        Setting::set('popup_button_url', $request->input('popup_button_url', ''), 'popup');
        Setting::set('popup_countdown', $request->input('popup_countdown', ''), 'popup');

        return back()->with('success', 'Configuración de popup promocional guardada.');
    }
}
