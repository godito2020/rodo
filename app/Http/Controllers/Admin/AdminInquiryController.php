<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInquiry;

class AdminInquiryController extends Controller
{
    public function index()
    {
        $inquiries = ContactInquiry::latest()->paginate(15);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(int $id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $inquiry->update(['is_read' => true]);
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function destroy(int $id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Mensaje eliminado.');
    }
}
