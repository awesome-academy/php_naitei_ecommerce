<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    protected $fillable = [
        'address',
        'slug',
        'startday',
        'dueday',
        'order_total',
        'user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
