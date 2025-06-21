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
