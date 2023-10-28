<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $primaryKey = 'pet';

    protected $fillable = [ 
        'pet',
    ];

    public function user_info()
    {
        return $this->belongsToMany(User_Info::class, 'pivot_pets', 'pet', 'user_id');
    }
}
