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

    public function residence()
    {
        return $this->belongsToMany(Residence::class);
    }

    public function hobby()
    {
        return $this->belongsToMany(Hobby::class);
    }

    public function language()
    {
        return $this->belongsToMany(Language::class);
    }

    public function pet()
    {
        return $this->belongsToMany(Pet::class);
    }
}
