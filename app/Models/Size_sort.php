<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Size;

class Size_sort extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function products()
    {
        return $this->hasMany(Product::class, 'size_sort', 'id');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class, 'size_sort', 'id');
    }
}
