<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'wishlist_code'
    ];

    public function getRouteKeyName()
    {
        return 'wishlist_code';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
