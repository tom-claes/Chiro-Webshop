<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Size;
use App\Models\OrderProducts;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_nr';

    public $incrementing = false;

    protected $fillable = ['order_nr', 'total_price' , 'lastname', 'firstname', 'email', 'phone', 'street', 'streetnr', 'zip', 'city'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_nr', 'product_id')
                    ->using(OrderProducts::class)
                    ->withPivot('size_id', 'quantity');
    }


}
