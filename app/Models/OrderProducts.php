<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Size;


class OrderProducts extends Pivot
{
    public function size() {
        return $this->belongsTo(Size::class, 'size_id');
    }
}