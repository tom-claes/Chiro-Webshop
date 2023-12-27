<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Size_sort;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['size_sort', 'size'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size_pivot')->withPivot('stock');
    }

    public function sizeSort()
    {
        return $this->belongsTo(Size_sort::class);
    }

    // The `boot` method is called when the model is being booted.
    protected static function boot()
    {
        parent::boot();

        // Using the `created` Eloquent event to automatically trigger a function after a new size is created.
        static::created(function ($size) {
            $size->updateProductSizePivot();
        });
    }

    // A method to update the `product_size_pivot` table for the associated products.
    public function updateProductSizePivot()
    {
        // Get the IDs of products associated with the same size_sort_id as the size.
        $products = Product::where('size_sort', $this->size_sort)->pluck('id');

        // Sync the products in the `product_size_pivot` table for the current size.
        $this->products()->sync($products);
    }
}
