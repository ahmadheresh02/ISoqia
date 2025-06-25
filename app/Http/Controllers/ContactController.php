<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'package' => 'nullable|string|max:255',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
