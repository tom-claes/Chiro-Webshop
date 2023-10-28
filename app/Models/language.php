<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'language';

    protected $fillable = [ 
        'language',
    ];

    public function user_info()
    {
        return $this->belongsToMany(User_Info::class, 'pivot_languages', 'language', 'user_id');
    }
}
