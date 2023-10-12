<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WishlistRequest $request)
    {
        // get user id from search query
        $userId = $request->query('user_id');

        if ($userId) {
            $wishlists = Wishlist::query()
                ->where('user_id', $userId)
                ->with('products')
                ->orderBy('created_at', 'desc')
                ->get();
            return WishlistResource::collection($wishlists);
        }

        $wishlist = Wishlist::query()
            ->with('products')
            ->orderBy('created_at', 'desc')
            ->get();

        return WishlistResource::collection($wishlist);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WishlistRequest $request)
    {
        $wishlist = Wishlist::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'wishlist_code' => substr(md5(rand()), 0, 10),
            'description' => $request->description,
        ]);

        return new WishlistResource($wishlist);
    }

    /**
     * Display the specified resource.
     */
    public function show(WishlistRequest $request, Wishlist $wishlist)
    {

        $wishlist->load('products');
        return new WishlistResource($wishlist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WishlistRequest $request, Wishlist $wishlist)
    {
        $wishlist->update($request->only('name', 'description'));
        return new WishlistResource($wishlist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishlistRequest $request, Wishlist $wishlist)
    {
        $wishlist->delete();
    }
}
