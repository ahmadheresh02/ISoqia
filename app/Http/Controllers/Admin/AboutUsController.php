<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::with('updatedBy')->first();

        if (!$aboutUs) {
            $aboutUs = AboutUs::create([
                'title' => 'About Us',
                'content' => 'Welcome to SOQIA - Innovative Environmental Solutions',
                'updated_by' => Auth::user()->id
            ]);
        }

        return view('admin.about.index', compact('aboutUs'));
    }

    public function edit()
    {
        $aboutUs = AboutUs::first();

        if (!$aboutUs) {
            $aboutUs = AboutUs::create([
                'title' => 'About Us',
                'content' => 'Welcome to SOQIA - Innovative Environmental Solutions',
                'updated_by' => Auth::user()->id
            ]);
        }

        return view('admin.about.edit', compact('aboutUs'));
    }

//     public function edit($id)
// {
//     $about = AboutUs::findOrFail($id);
//     return view('admin.about.edit', compact('about'));
// }


    // public function update(Request $request, $id)
    // {
    //     $about = AboutUs::findOrFail($id);
    //     $about->update($request->all());
    //     return redirect()->route('about.edit', $id);
    // }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aboutUs = AboutUs::first();

        if (!$aboutUs) {
            $aboutUs = new AboutUs();
        }

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'updated_by' => Auth::user()->id,
            'updated_at' => now()
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($aboutUs->image_url) {
                Storage::delete('public/' . $aboutUs->image_url);
            }

            $image = $request->file('image');
            $imageName = time() . '_about_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/about', $imageName);
            $data['image_url'] = 'about/' . $imageName;
        }

        if ($aboutUs->exists) {
            $aboutUs->update($data);
        } else {
            AboutUs::create($data);
        }

        return redirect()->route('admin.about.index')
                        ->with('success', 'About Us page updated successfully!');
    }

}
