<?php

namespace App\Http\Controllers\Creators;

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use App\Enums\ProductTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DigitalProductRequest;
use App\Http\Requests\Product\LinkProductRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('creator.product.create-digital');
    }

    public function index_link()
    {
        return view('creator.product.create-link');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('creator.product.create-link');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DigitalProductRequest $request)
    {
        // DigitalProductRequest
        // $img = $request->img;
        // $base = base64_decode(preg_replace('#^data:image/\w+;base64,#i','',$img));
        // Storage::disk('public')->put('rea/img_'. Str::random(10).'.png', $base);
        $pathImages = array();
        if ($request->has('img')) {
            $pattern = '(data:application)';
            for ($i = 0; $i < count($request->img); $i++) {
                if (preg_match($pattern, $request->img[$i])) {
                    return redirect()->back()->with('error', 'Please upload valid file!');
                }
            }

            foreach ($request->img as $key => $image) {
                $base = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                $imgname = date('HisdmY') . '_' . Str::random(5) . '.png';
                Storage::disk('public')->put('products/digital/' . $imgname, $base);
                array_push($pathImages, $imgname);
            }
        }

        try {
            Product::create([
                'user_id' => auth()->user()->id,
                'type' => ProductTypeEnum::PRODUCT_DIGITAL,
                'name' => $request->name,
                'slug' => self::generateSlug(rand(5, 8)),
                // 'thumbnail' => ($request->thumbnail) ? $pathThumbnail : 'public/products/default.jpg',
                'thumbnail' => ($request->img) ? $pathImages[0] : NULL,
                // 'images' => ($request->img) ? json_encode($pathImages) : NULL,
                'images' => ($request->img) ? $pathImages : NULL,
                'description' => $request->description,
                'url' => $request->url,
                'min_price' => $request->min_price,
                'max_price' => $request->max_price,
                'messages' => ($request->messages) ? $request->messages : NULL,
                'cta_text' => ($request->cta_text) ? $request->cta_text : CtaEnum::CTA_NO_OPTION,
                'layout' => ($request->layout) ? $request->layout : LayoutEnum::LAYOUT_DEFAULT,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        // dd($request, $request['name']);
        return redirect()->route('creator')->with('success', 'Data created');
    }

    public function store_link(LinkProductRequest $request)
    {
        // dd($request->all());
        if ($request->hasFile('thumbnail')) {

            // $thumbnailName = date('HisdmY') . '_' . str_replace([' ','-'], '_', strtolower($request->name));
            $thumbnailName = date('HisdmY') . '_' . Str::random(5);
            $thumbnailPath = FileService::store(
                'public/products/link',
                $request->file('thumbnail'),
                $request->thumbnail->extension(),
                $thumbnailName
            );
            try {
                Product::create([
                    ...$request->validated(),
                    // 'type' => ProductTypeEnum::PRODUCT_LINK,
                    'user_id' => auth()->user()->id,
                    'thumbnail' => $thumbnailPath,
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            try {
                Product::create([
                    ...$request->validated(),
                    'type' => ProductTypeEnum::PRODUCT_LINK,
                    'user_id' => $request->user()->id,
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        return redirect()->route('creator')->with('success', 'Data created');
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
        $user = request()->user();
        return view('creator.product.update-digital', compact('product', 'user'));
    }

    public function edit_link(Product $product)
    {
        $user = request()->user();
        return view('creator.product.update-link', compact('product', 'user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DigitalProductRequest $request, Product $product)
    {
        $pathImages = array();
        $oldImageProduct = $product->images;

        if ($request->has('img')) {

            // check valid base64 file image, if false will back and give errors
            $pattern = '(data:application)';
            for ($i = 0; $i < count($request->img); $i++) {
                if (preg_match($pattern, $request->img[$i])) {
                    return redirect()->back()->with('error', 'Please upload valid file!');
                }
            }

            // save new images
            foreach ($request->img as $key => $image) {
                $pattern = '#^data:image/\w+;base64,#i';
                if (preg_match($pattern, $image)) {
                    $base = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                    $imgname = date('HisdmY') . '_' . Str::random(5) . '.png';
                    Storage::disk('public')->put('products/digital/' . $imgname, $base);
                    array_push($pathImages, $imgname);
                }
            }

            if ($product->images) {
                $newProductImages = array_merge($oldImageProduct, $pathImages);
                try {
                    $product->update([
                        'name' => $request->name,
                        'thumbnail' => $newProductImages[0],
                        'images' => $newProductImages,
                        'description' => $request->description,
                        'url' => $request->url,
                        'min_price' => $request->min_price,
                        'max_price' => $request->max_price,
                        'messages' => ($request->messages) ? $request->messages : NULL,
                        'cta_text' => ($request->cta_text) ? $request->cta_text : CtaEnum::CTA_NO_OPTION,
                        'layout' => ($request->layout) ? $request->layout : LayoutEnum::LAYOUT_DEFAULT,
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                try {
                    $product->update([
                        'name' => $request->name,
                        'thumbnail' => ($request->img) ? $pathImages[0] : NULL,
                        'images' => ($request->img) ? $pathImages : NULL,
                        'description' => $request->description,
                        'url' => $request->url,
                        'min_price' => $request->min_price,
                        'max_price' => $request->max_price,
                        'messages' => ($request->messages) ? $request->messages : NULL,
                        'cta_text' => ($request->cta_text) ? $request->cta_text : CtaEnum::CTA_NO_OPTION,
                        'layout' => ($request->layout) ? $request->layout : LayoutEnum::LAYOUT_DEFAULT,
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        } else {
            try {
                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'url' => $request->url,
                    'min_price' => $request->min_price,
                    'max_price' => $request->max_price,
                    'messages' => ($request->messages) ? $request->messages : NULL,
                    'cta_text' => ($request->cta_text) ? $request->cta_text : CtaEnum::CTA_NO_OPTION,
                    'layout' => ($request->layout) ? $request->layout : LayoutEnum::LAYOUT_DEFAULT,
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }


        return redirect()->route('creator');
    }


    public function update_link(LinkProductRequest $request, Product $product)
    {
        $currentUserId = $request->user()->id;
        if ($request->hasFile('thumbnail')) {

            if ($product->thumbnail) {
                Storage::delete($product->thumbnail);
            }

            $thumbnailName = date('HisdmY') . '_' . str_replace([' ', '-'], '_', strtolower($request->name));
            $thumbnailPath = FileService::store(
                'public/products/link',
                $request->file('thumbnail'),
                $request->thumbnail->extension(),
                $thumbnailName
            );

            $product->where('user_id', $currentUserId)->where('id', $product->id)->update([
                ...$request->validated(),
                // 'slug' => 2,
                'thumbnail' => $thumbnailPath,
            ]);
        } else {
            $product->where('user_id', $currentUserId)->where('id', $product->id)->update([
                ...$request->validated(),
                // 'slug' => 2,
                // 'name' => $request->title,
                // 'url' => $request->url,
                // 'layout' => $request->layout,
            ]);
        }

        return redirect()->route('creator')->with('success', 'Data updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            Transaction::where('product_id', $product->id)->delete();
            if ($product->images) {
                foreach ($product->images as $key => $value) {
                    Storage::delete('public/products/digital/' . $value);
                }
            }
            $product->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('creator');
    }

    public function destroy_link(Product $product)
    {
        if ($product->thumbnail) {
            Storage::delete($product->thumbnail);
        }
        $product->delete();

        return redirect()->route('creator');
    }

    public function delete_image(Request $request, Product $product)
    {
        $oldImg = [...$product->images];
        $listImages = [...$product->images];
        $indexImage = $request->image;

        if ($request->has('image')) {

            if (array_key_exists($indexImage, $listImages)) {
                unset($listImages[$indexImage]);
                $listImages = array_values($listImages);
                Storage::delete('public/products/digital/' . $product->images[$indexImage]);
            }

            $product->where('user_id', $request->user()->id)->where('id', $product->id)->update([
                'thumbnail' => $listImages ? $listImages[0] : NULL,
                'images' => (count($listImages) > 0) ? json_encode($listImages) : NULL,
            ]);

            return response()->json([
                'message' => 'Image deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Image not found'
            ]);
        }
    }
    public function delete_image_link(Request $request, Product $product)
    {
        Storage::delete($product->thumbnail);
        $product->where('user_id', $request->user()->id)->where('id', $product->id)->update([
            'thumbnail' => NULL,
        ]);

        return response()->json([
            'message' => 'Image deleted successfully'
        ]);
    }

    // Generate random slug
    public  static function generateSlug(int $length)
    {
        $alphanum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $str = '';

        for ($i = 0; $i < $length; $i++) {
            $str .= $alphanum[rand(0, strlen($alphanum) - 1)];
        }
        return $str . rand(1, 100);
    }

    // GET PRODUCTS FROM USERNAME
    public function product_user(User $user, Product $product)
    {
        return view('cart.detail-produk', compact('user', 'product'));
    }
}
