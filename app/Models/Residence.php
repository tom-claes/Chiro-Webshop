<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [ 
        'residence',
    ];

    public function user_info()
    {
        return $this->belongsToMany(User_Info::class);
    }
}
