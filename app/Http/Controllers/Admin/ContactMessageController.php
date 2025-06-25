<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{

    public function index()
    {
        $messages = ContactMessage::where('is_visible', true)
            ->latest()
            ->paginate(10);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function send(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'subject' => 'required|string', // maps to 'title'
        'message' => 'required|string', // maps to 'description'
        'phone' => 'nullable|string',
        'package' => 'nullable|string',
    ]);

    ContactMessage::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'title' => $validated['subject'],
        'description' => $validated['message'],
        'phone' => $validated['phone'] ?? null,
        'package' => $validated['package'] ?? null,
    ]);

    return back()->with('success', 'Your message has been sent. Thank you!');
}

    public function show(ContactMessage $message)
    {
        if (!$message->read_at) {
            $message->markAsRead();
        }

        return view('admin.contact-messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->update(['is_visible' => false]);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message hidden successfully');
    }

    public function trash()
    {
        $messages = ContactMessage::where('is_visible', false)
            ->latest()
            ->paginate(10);

        return view('admin.contact-messages.trash', compact('messages'));
    }

    public function restore($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_visible' => true]);

        return redirect()->route('admin.contact-messages.trash')
            ->with('success', 'Message restored successfully');
    }
}
