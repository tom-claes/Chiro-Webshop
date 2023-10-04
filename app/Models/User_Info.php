<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Info extends Model
{
    use HasFactory;

    protected $table = 'user_infos';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'bio',
        'residence',
        'language',
        'pet',
        'hobby',
        'interest',
        'toy',
        'food',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
