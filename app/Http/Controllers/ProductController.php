<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductRequest $request)
    {
        $products = Product::query()
            ->orderBy('created_at', 'desc')
            ->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $wishlist = Wishlist::query()
            ->where('wishlist_code', $request->wishlist_code)
            ->firstOrFail();

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'product_code' => substr(md5(rand()), 0, 10),
            'is_acquired' => false,
            'description' => $request->description,
            'wishlist_id' => $wishlist->id,
            'image_url' => $request->image_url,
        ]);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductRequest $request, Product $product)
    {
        $product->load('wishlist');
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRequest $request, Product $product)
    {
        $product->delete();
    }
}
