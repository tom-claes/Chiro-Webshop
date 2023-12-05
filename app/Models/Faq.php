<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Faq_category;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'category'];

    public function category()
    {
        return $this->belongsTo(Faq_category::class, 'category', 'id');
    }
}
