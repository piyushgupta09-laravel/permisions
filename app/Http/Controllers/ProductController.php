<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::active()->get();
        return view('products.index', [
            'products' => $products->sortByDesc('updated_at')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if ($product->archive) {
            return back();
        }

        return view('products.show', [
            'product' => $product
        ]);
    }

    // ADMIN ACCESS ONLY

    public function archived()
    {
        $products = Product::archived()->get();
        return view('products.index', [
            'products' => $products
        ]);
    }

    public function deleted()
    {
        $products = Product::onlyTrashed()->get();
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title = request('title');
        $product->short = request('short');
        $product->price = request('price');
        $product->unit = request('unit');
        $product->detail = request('detail');
        if($request->hasfile('image')) {
            $image_path = $request->file('image')->store('public/products');
            $product->image = Str::replaceFirst('public/products/', '/', $image_path);
        }
        $product->save();
        return redirect()->route('products.show', $product->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product_updated = false;
        if ($request->has('title') && ($request->title != $product->title)) {
            $product->title = request('title');
            $product_updated = true;
        }
        if ($request->has('short') && ($request->short != $product->short)) {
            $product->short = request('short');
            $product_updated = true;
        }
        if ($request->has('price') && ($request->price != $product->price)) {
            $product->price = request('price');
            $product_updated = true;
        }
        if ($request->has('unit') && ($request->unit != $product->unit)) {
            $product->unit = request('unit');
            $product_updated = true;
        }
        if ($request->has('detail') && ($request->detail != $product->detail)) {
            $product->detail = request('detail');
            $product_updated = true;
        }
        if ($request->has('archive')) {
            $product->archive = true;
            $product_updated = true;
        } else {
            $product->archive = false;
            $product_updated = true;
        }
        if($request->hasfile('image') && Storage::exists('public/products', $product->image)) {
            $previous_filename = $product->image;
            $image_path = $request->file('image')->store('public/products');
            $product->image = Str::replaceFirst('public/products/', '/', $image_path);
            // Delete old image after confirming new image uploded succefully
            if ($previous_filename != $product->image) {
                Storage::delete('public/products/' . $previous_filename);
                $product_updated = true;
            }
        }
        if ($product_updated) {
            $product->save();
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $product = Product::where('slug', $request->slug)->withTrashed()->first();
        Storage::delete('public/products/' . $product->image);
        $product->forceDelete();
        return redirect()->route('products.index');
    }

    public function restore(Request $request)
    {
        $product = Product::where('slug', $request->slug)->withTrashed()->first();
        $product->restore();
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function archive(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        $product->archive = !$product->archive;
        $product->update();
        return redirect()->route('products.index');
    }
}
