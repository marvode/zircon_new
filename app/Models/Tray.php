<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tray extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderItem()
    {
        return $this->belongsTo(Orderitem::class);
    }

    public function fooditems()
    {
        return $this->belongsToMany(Fooditem::class);
    }
}
