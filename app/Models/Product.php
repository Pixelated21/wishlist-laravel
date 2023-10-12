<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'wishlist_id',
        'product_code',
        'name',
        'price',
        'description',
        'is_acquired',
        'image_url'
    ];

    public function getRouteKeyName()
    {
        return 'product_code';
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }
}
