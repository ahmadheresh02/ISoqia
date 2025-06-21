<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IconController extends Controller
{
    /**
     * Display a listing of the icons.
     */
    public function index()
    {
        $icons = Icon::latest()->paginate(10);
        return view('admin.icons.index', compact('icons'));
    }

    /**
     * Show the form for creating a new icon.
     */
    public function create()
    {
        return view('admin.icons.create');
    }

    /**
     * Store a newly created icon in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('icon')->store('icons', 'public');

        Icon::create([
            'path' => $path
        ]);

        return redirect()->route('admin.icons.index')
            ->with('success', 'Icon uploaded successfully.');
    }

    /**
     * Display the specified icon.
     */
    public function show(Icon $icon)
    {
        return view('admin.icons.show', compact('icon'));
    }

    /**
     * Show the form for editing the specified icon.
     */
    public function edit(Icon $icon)
    {
        return view('admin.icons.edit', compact('icon'));
    }

    /**
     * Update the specified icon in storage.
     */
    public function update(Request $request, Icon $icon)
    {
        $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            // Delete old icon
            Storage::delete($icon->storage_path);

            // Store new icon
            $path = $request->file('icon')->store('icons', 'public');
            $icon->update(['path' => $path]);
        }

        return redirect()->route('admin.icons.index')
            ->with('success', 'Icon updated successfully.');
    }

    /**
     * Remove the specified icon from storage.
     */
    public function destroy(Icon $icon)
    {
        Storage::delete($icon->storage_path);
        $icon->delete();

        return redirect()->route('admin.icons.index')
            ->with('success', 'Icon deleted successfully.');
    }
}
