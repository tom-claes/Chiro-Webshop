<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Faq;

class Faq_category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function faq()
    {
        return $this->hasMany(Faq::class, 'category', 'id');
    }
}
