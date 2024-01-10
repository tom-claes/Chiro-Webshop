<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_nr', 'total_price' , 'lastname', 'firstname', 'email', 'phone', 'street', 'streetnr', 'zip', 'city'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_nr', 'product_id')->withPivot('size_id', 'quantity');
    }

    public function orderProducts()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_nr', 'product_id')
                    ->withPivot('size_id', 'quantity')
                    ->as('order_product')
                    ->select('*');
    }
}
