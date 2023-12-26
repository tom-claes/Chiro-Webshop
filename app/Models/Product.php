<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_category;
use App\Models\Size;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'size_sort',
        'category',
        'price',
        'img'
    ];

    public function category()
    {
        return $this->belongsTo(Product_category::class, 'category', 'id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size_pivot')->withPivot('stock');
    }

    // The `boot` method is called when the model is being booted.
    protected static function boot()
    {
        parent::boot();

        // Using the `created` Eloquent event to automatically trigger a function after a new product is created.
        static::created(function ($product) {
            $product->updateProductSizePivot();
        });
    }

    // A method to update the `product_size_pivot` table for the associated sizes.
    public function updateProductSizePivot()
    {
        // Get the IDs of sizes associated with the same size_sort_id as the product.
        $sizes = Size::where('size_sort', $this->size_sort)->pluck('id');

        // Sync the sizes in the `product_size_pivot` table for the current product.
        $this->sizes()->sync($sizes);
    }
}
