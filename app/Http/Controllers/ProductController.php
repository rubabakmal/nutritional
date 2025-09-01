<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Display featured products for homepage
     */
    public function featured()
    {

        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->where('status', 'active')
            ->latest()
            ->limit(8)
            ->get();

        return view('index', compact('featuredProducts'));
    }

    /**
     * Get most loved products for homepage section
     */
    public function getMostLoved()
    {
        $mostLovedProducts = Product::with('category')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return $mostLovedProducts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,inactive,out_of_stock',
            'is_featured' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = $request->input('status', 'active');
        $validated['is_featured'] = $request->has('is_featured');

        $validated['sku'] = 'PRD-' . strtoupper(Str::random(8));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPaths[] = $galleryImage->store('products/gallery', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,inactive,out_of_stock',
            'is_featured' => 'boolean',
            'removed_gallery_images' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = $request->input('status', 'active');
        $validated['is_featured'] = $request->has('is_featured');

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        $currentGallery = $product->gallery ?? [];
        $updatedGallery = $currentGallery;

        if ($request->has('removed_gallery_images') && !empty($request->input('removed_gallery_images'))) {
            $removedImages = json_decode($request->input('removed_gallery_images'), true);

            if (is_array($removedImages)) {
                foreach ($removedImages as $imageToRemove) {
                    Storage::disk('public')->delete($imageToRemove);
                    $updatedGallery = array_values(array_diff($updatedGallery, [$imageToRemove]));
                }
            }
        }


        if ($request->hasFile('gallery')) {
            $newGalleryPaths = [];
            foreach ($request->file('gallery') as $galleryImage) {
                $newGalleryPaths[] = $galleryImage->store('products/gallery', 'public');
            }

            $updatedGallery = array_merge($updatedGallery, $newGalleryPaths);
        }

        $validated['gallery'] = $updatedGallery;
        unset($validated['removed_gallery_images']);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete main image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete gallery images if exist
        if ($product->gallery && is_array($product->gallery)) {
            foreach ($product->gallery as $galleryImage) {
                Storage::disk('public')->delete($galleryImage);
            }
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
    public function detail_show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return redirect()->route('homepage')->with('error', 'Product not found');
        }

        $relatedProducts = Product::with('category')
            ->where('status', 'active')
            ->where('id', '!=', $id) // Exclude current product
            ->where('category_id', $product->category_id) // Same category
            ->limit(4)
            ->get();

        if ($relatedProducts->count() < 4) {
            $additionalProducts = Product::with('category')
                ->where('status', 'active')
                ->where('id', '!=', $id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->limit(4 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->merge($additionalProducts);
        }

        return view('product-detail', compact('product', 'relatedProducts'));
    }
}
