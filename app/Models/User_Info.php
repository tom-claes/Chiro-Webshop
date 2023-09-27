<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Info extends Model
{
    use HasFactory;

    protected $fillable = [
        'bio',
        'residence',
        'language',
        'pet',
        'hobby',
        'interest',
        'toy',
        'food',
    ];
}
