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
        'user_id',
        'bio',
        'interest',
        'toy',
        'food',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function residences()
    {
        return $this->belongsToMany(Residence::class, 'pivot_residences', 'user_id', 'residence');
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'pivot_hobbies', 'user_id', 'hobby');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'pivot_languages', 'user_id', 'language');
    }

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'pivot_pets', 'user_id', 'pet');
    }
}
