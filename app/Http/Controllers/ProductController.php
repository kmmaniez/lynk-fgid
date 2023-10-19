<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'hi';
    }

    public function index_link()
    {
        return 'hi link';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->hasFile('thumbnail')) {
            $pathThumbnail = $request->file('thumbnail');
        }

        if ($request->hasFile('images')) {
            $pathImages = $request->file('images');
        }
        // Product::create([
        //     'user_id' => auth()->user()->id,
        //     'name' => $request->name,
        //     'slug' => Str::random(6),
        //     'thumbnail' => $pathThumbnail,
        //     'images' => $pathImages,
        //     'description' => $request->description,
        //     'url' => ($request->url) ? $request->url : NULL,
        //     'min_price' => ($request->min_price) ? $request->min_price : NULL,
        //     'max_price' => ($request->max_price) ? $request->max_price : NULL,
        //     'messages' => ($request->messages) ? $request->messages : NULL,
        //     'CTA' => ($request->cta_text) ? $request->cta_text : NULL,
        //     'layout' => ($request->layout) ? $request->layout : NULL,
        // ]);
        dd($request->all());
    }

    public function store_link(ProductRequest $request)
    {
        // dd($request->all());
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = date('HisdmY') . '_' . str_replace([' ','-'], '_', strtolower($request->title)) . '.' . $request->thumbnail->extension();
            $thumbnailPath = Storage::putFileAs('public/products', $request->file('thumbnail'), $thumbnailName);

            Product::create([
                'user_id' => auth()->user()->id,
                'thumbnail' => $thumbnailPath,
                'name' => $request->title,
                'url' => $request->url,
                'layout' => $request->layout,
            ]);
        }else{
            Product::create([
                'user_id' => auth()->user()->id,
                'name' => $request->title,
                'url' => $request->url,
                'layout' => $request->layout,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
