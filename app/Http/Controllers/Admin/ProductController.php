<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::whereNull('deleted_at');

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'stock':
                    $query->orderBy('stock_quantity', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->with('images')->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create($request->only([
            'name',
            'description',
            'price',
            'stock_quantity'
        ]));

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image');
            $featuredImageName = time() . '_featured_' . Str::random(10) . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImage->storeAs('public/products', $featuredImageName);
            $product->update(['featured_image_url' => 'products/' . $featuredImageName]);
        }

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $image) {
                $imageName = time() . '_' . $index . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/products', $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => 'products/' . $imageName,
                    'sort_order' => $index + 1
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load('images', 'orderItems.order');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update($request->only([
            'name',
            'description',
            'price',
            'stock_quantity'
        ]));

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($product->featured_image_url) {
                Storage::delete('public/' . $product->featured_image_url);
            }

            $featuredImage = $request->file('featured_image');
            $featuredImageName = time() . '_featured_' . Str::random(10) . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImage->storeAs('public/products', $featuredImageName);
            $product->update(['featured_image_url' => 'products/' . $featuredImageName]);
        }

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $image) {
                $imageName = time() . '_' . $index . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/products', $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => 'products/' . $imageName,
                    'sort_order' => $product->images->count() + $index + 1
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->update(['deleted_at' => now()]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    public function deleteImage(ProductImage $image)
    {
        Storage::delete('public/' . $image->image_url);
        $image->delete();

        return response()->json(['success' => true]);
    }
}
