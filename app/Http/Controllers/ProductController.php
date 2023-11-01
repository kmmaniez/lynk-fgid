<?php

namespace App\Http\Controllers;

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use App\Enums\ProductEnum;
use App\Enums\ProductTypeEnum;
use App\Http\Requests\Product\DigitalProductRequest;
use App\Http\Requests\Product\LinkProductRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('creator.digitalproduk');
        // $file = Storage::files('public/tes')[0];
        // $aw = Storage::mimeType('public/tes/'.$file);
        // dump(Storage::files('public/tes')[0], $file, $aw);

        // dump(array_column(CtaEnum::cases(),'value','name'), CtaEnum::cases());
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
            for ($i=0; $i < count($request->img); $i++) { 
                if (preg_match($pattern, $request->img[$i])) {
                    return redirect()->back()->with('error','Please upload valid file!');
                }
            }

            foreach ($request->img as $key => $image) {
                $base = base64_decode(preg_replace('#^data:image/\w+;base64,#i','', $image));
                $imgname = date('HisdmY').'_'.Str::random(5).'.png';
                Storage::disk('public')->put('tes/'.$imgname, $base);
                array_push($pathImages,$imgname);
            }
            
        }

        try {
            $ea = Product::create([
                'user_id' => auth()->user()->id,
                'type' => ProductTypeEnum::PRODUCT_DIGITAL,
                'name' => $request->name,
                'slug' => self::generateSlug(7),
                // 'thumbnail' => ($request->thumbnail) ? $pathThumbnail : 'public/products/default.jpg',
                'thumbnail' => ($request->img) ? $pathImages[0] : 'public/tes/default.jpg',
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
        return redirect()->route('admin')->with('success','Data created');
    }

    public function store_link(LinkProductRequest $request)
    {
        // dd($request->all());
        if ($request->hasFile('thumbnail')) {

            // $thumbnailName = date('HisdmY') . '_' . str_replace([' ','-'], '_', strtolower($request->name));
            $thumbnailName = date('HisdmY') . '_' . Str::random(5);
            $thumbnailPath = FileService::store(
                'public/products', 
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
        }else{
            // $ea = 
            // $slug =  self::generateSlug(6);
            // $slugExist = Product::where('slug','aduh')->first();
            // if ($slugExist) {
            //     echo 'ada';
            // }
            // dump($slugExist);
            // $status = false;
            // echo $slug.'<br>';
            // $a = 0;
            // do {
            //     echo $a++.'<br>';
            //     if ($a == 8 || $a == 15) {
            //         $status = true;
            //         echo 'STOPPED '.$a++.'<br>';
            //         continue;
            //     }
            // } while ($status != true);
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

        return redirect()->route('admin')->with('success','Data created');
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
        // dump($product->images);
        $user = request()->user();
        $arr = ["04163523102023_n0yJP.png", //0
                "04163523102023_jOt1Z.png", //1
                "04163523102023_33UKl.png", //2
                "04163523102023_xz5yl.png" //3
            ];
        // dump($arr);
        // $index = 1;
        // if (array_key_exists($index, $arr)) {
        //     unset($arr[$index]);
        //     $arr = array_values($arr);
        // }
        // dump($arr);
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
            for ($i=0; $i < count($request->img); $i++) { 
                if (preg_match($pattern, $request->img[$i])) {
                    return redirect()->back()->with('error','Please upload valid file!');
                }
            }

            // save new images
            foreach ($request->img as $key => $image) {
                $pattern = '#^data:image/\w+;base64,#i';
                if (preg_match($pattern, $image)) {
                    $base = base64_decode(preg_replace('#^data:image/\w+;base64,#i','', $image));
                    $imgname = date('HisdmY').'_'.Str::random(5).'.png';
                    Storage::disk('public')->put('tes/'.$imgname, $base);
                    array_push($pathImages,$imgname);
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

            }else{
                try {
                    $product->update([
                        'name' => $request->name,
                        'thumbnail' => ($request->img) ? $pathImages[0] : 'public/tes/default.jpg',
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
            
        }else{
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
        

        return redirect()->route('admin');
    }


    public function update_link(LinkProductRequest $request, Product $product)
    {
        $currentUserId = $request->user()->id;
        if ($request->hasFile('thumbnail')) {
            
            if ($product->thumbnail) {
                Storage::delete($product->thumbnail);
            }

            $thumbnailName = date('HisdmY') . '_' . str_replace([' ','-'], '_', strtolower($request->name));
            $thumbnailPath = FileService::store(
                'public/products', 
                $request->file('thumbnail'),
                $request->thumbnail->extension(), 
                $thumbnailName
            );

            $product->where('user_id', $currentUserId)->where('id',$product->id)->update([
                ...$request->validated(),
                // 'slug' => 2,
                'thumbnail' => $thumbnailPath,
            ]);
        }else{
            $product->where('user_id', $currentUserId)->where('id',$product->id)->update([
                ...$request->validated(),
                // 'slug' => 2,
                // 'name' => $request->title,
                // 'url' => $request->url,
                // 'layout' => $request->layout,
            ]);
        }

        return redirect()->route('admin')->with('success','Data updated');
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
                    Storage::delete('public/tes/'. $value);
                }
            }
            $product->delete();
            
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin');
    }

    public function destroy_link(Product $product)
    {
        if ($product->thumbnail) {
            Storage::delete($product->thumbnail);
        }
        $product->delete();

        return redirect()->route('admin');
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
                Storage::delete('public/tes/'. $product->images[$indexImage]);
            }

            $product->where('user_id', $request->user()->id)->where('id', $product->id)->update([
                'thumbnail' => $listImages ? $listImages[0] : NULL,
                'images' => (count($listImages) > 0) ? json_encode($listImages) : NULL,
            ]);

            return response()->json([
                'img' => $request->image,
                'old_img' => $oldImg,
                'new_img' => $listImages,
            ]);
        }else{
            return response()->json([
                'data' => $product,
                'req' => $request->all(),
                'aw' => 'kosong',
                'img' => $request->image,
                'old_img' => $oldImg,
                'new_img' => $listImages,
                'leng_old' => count($oldImg),
                'leng_new' => count($listImages),
            ]);
        }
        // if ($product->thumbnail) {
        //     // Storage::delete($product->thumbnail);
            
        //     // $product->where('user_id', $request->user_id)->where('id', $product->id)->update([
        //     //     'thumbnail' => NULL,
        //     // ]);
        //     return response()->json([
        //         'data' => $product,
        //         // 'img' => $product->images[$request->data_img],
        //         'req' => $request->all(),
        //         'aw' => 'ada',
        //     ]);
        // }else{
        //     return response()->json([
        //         'data' => $product,
        //         'req' => $request->all(),
        //         'aw' => 'kosong'
        //     ]);
        // }

    }

    // Generate random slug
    public  static function generateSlug(int $length)
    {
        // digital product = 7 length
        // link product = 6 length
        $userId = request()->user()->id;
        $alphanum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $str = '';

        for ($i=0; $i < $length; $i++) { 
            $str .= $alphanum[rand(0, strlen($alphanum) - 1)];
        }
        return $str;
    }

    // Get enum from input
    public  static function getEnumProduct(CtaEnum $product)
    {
        // switch ($product) {
        //     case ProductEnum::CTA_NO_OPTION:
        //         return 'I Want this';
        //         break;
        //     case ProductEnum::CTA_OPTION_1:
        //         return 'Support Creator';
        //         break;
        //     case ProductEnum::CTA_OPTION_2:
        //         return 'Beli Sekarang';
        //         break;
        //     case ProductEnum::CTA_OPTION_3:
        //         return 'Book Now';
        //         break;
        //     default:
        //         break;
        // }
    }
    
    public function product_user(User $user, Product $product) {
        // echo 'ok';
        // dd($user,$product);
        return view('creator.products.detail-produk', compact('user', 'product'));
    }

    public function tes() {
        return view('creator.product.tes');
    }
}
