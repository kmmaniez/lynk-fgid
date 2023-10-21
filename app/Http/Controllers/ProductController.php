<?php

namespace App\Http\Controllers;

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use App\Enums\ProductEnum;
use App\Enums\ProductTypeEnum;
use App\Http\Requests\Product\DigitalProductRequest;
use App\Http\Requests\Product\LinkProductRequest;
use App\Models\Product;
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
    public function store(Request $request)
    {
        // DigitalProductRequest
        // $img = $request->img;
        // $base = base64_decode(preg_replace('#^data:image/\w+;base64,#i','',$img));
        // Storage::disk('public')->put('rea/img_'. Str::random(10).'.png', $base);
        $arrImages = array(...$request->img);
        $pathImg = array();
        foreach ($request->img as $key => $image) {
            $base = base64_decode(preg_replace('#^data:image/\w+;base64,#i','', $image));
            $imgname = date('HisdmY').'_'.Str::random(5).'.png';
            $aw = Storage::disk('public')->put('tes/'. $imgname, $base);
            // dump($aw);
            array_push($pathImg,$imgname);
            // $imageName = date('HisdmY').'_'.Str::random(5).'.png';
            // $imagePath = Storage::putFileAs('tes/', $base, $imageName);
            // dump($imagePath);
        }
        // dump($pathImg);
        // dd($request->all(), $arrImages);
        if ($request->hasFile('thumbnail')) {
            $pathThumbnail = $request->file('thumbnail');
        }

        // if ($request->hasFile('images')) {
        //     $pathImages = $request->file('images');
        // }

        if (!array_key_exists($request->cta_text, CtaEnum::cases())) {
            // return redirect()->back()->with('cta_text','The cta text field is required.');
            // dump(ProductEnum::cases());  
            // echo 'ada';
        }
        // die;
        try {
            $ea = Product::create([
                'user_id' => auth()->user()->id,
                'type' => ProductTypeEnum::PRODUCT_DIGITAL,
                'name' => $request->name,
                'slug' => self::generateSlug(7),
                // 'thumbnail' => ($request->thumbnail) ? $pathThumbnail : 'public/products/default.jpg',
                'thumbnail' => ($request->img) ? $pathImg[0] : 'public/products/default.jpg',
                'images' => ($request->img) ? json_encode($pathImg) : NULL,
                'description' => $request->description,
                'url' => $request->url,
                'min_price' => $request->min_price,
                'max_price' => $request->max_price,
                'messages' => ($request->messages) ? $request->messages : NULL,
                'cta_text' => ($request->cta_text) ? $request->cta_text : 0,
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

            $thumbnailName = date('HisdmY') . '_' . str_replace([' ','-'], '_', strtolower($request->name));
            $thumbnailPath = FileService::store(
                'public/products', 
                $request->file('thumbnail'),
                $request->thumbnail->extension(), 
                $thumbnailName
            );
            try {
                Product::create([
                    ...$request->validated(),
                    'type' => ProductTypeEnum::PRODUCT_LINK,
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
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('thumbnail')) {

            if ($product->thumbnail) {
                Storage::delete($product->thumbnail);
            }
            $thumbnailName = date('HisdmY') . '_' . str_replace([' ','-'], '_', strtolower($request->title)) . '.' . $request->thumbnail->extension();
            // $thumbnailPath = Storage::putFileAs('public/products', $request->file('thumbnail'), $thumbnailName);
            // $thumbnailPath = FileService::store('public/products', $request->file('thumbnail'), $thumbnailName);

            // Product::create([
            //     'user_id' => auth()->user()->id,
            //     'slug' => 2,
            //     'thumbnail' => $thumbnailPath,
            //     'name' => $request->title,
            //     'url' => $request->url,
            //     'layout' => $request->layout,
            // ]);
        }else{
            Product::create([
                'user_id' => auth()->user()->id,
                'slug' => 'aduh',
                'name' => $request->title,
                'url' => $request->url,
                'layout' => $request->layout,
            ]);
        }
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
            // Product::create([
            //     'user_id' => auth()->user()->id,
            //     'slug' => 'aduh',
            //     'name' => $request->title,
            //     'url' => $request->url,
            //     'layout' => $request->layout,
            // ]);
            // dd($request->all());
        }

        return redirect()->route('admin')->with('success','Data updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
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
        if ($product->thumbnail) {
            Storage::delete($product->thumbnail);
            
            $product->where('user_id', $request->user_id)->where('id', $product->id)->update([
                'thumbnail' => NULL,
            ]);
            
            return response()->json([
                'data' => $product,
                'req' => $request->all(),
            ]);
        }
    }

    // Generate random slug
    public  static function generateSlug(int $length)
    {
        // digital product = 7 length
        // link product = 6 length
        $alphanum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $str = '';

        // $slugExist = Product::where('slug','aduh')->first();
        // $status = false;
        // $a = 0;
        // do {
        //     echo $a++.'<br>';
        //     if ($slugExist) {
        //         $status = true;
        //         echo 'STOPPED '.$a++.'<br>';
        //         continue;
        //     }
        // } while ($status != true);
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
    
    public function tes() {
        return view('creator.product.tes');
    }
}
