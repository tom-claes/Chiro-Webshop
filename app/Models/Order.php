<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['ordernr', 'lastname', 'firstname', 'email', 'phone', 'street', 'streetnr', 'zip', 'city'];
}
