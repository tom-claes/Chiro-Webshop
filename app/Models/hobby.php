<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [ 
        'hobby',
    ];

    public function user_info()
    {
        return $this->belongsToMany(User_Info::class, 'pivot_hobbies', 'hobby', 'user_id');
    }
}
