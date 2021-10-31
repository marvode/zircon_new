<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dotenv\Util\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const ORDER_PENDING = 'pending';
    const ORDER_FAILED = 'failed';
    const ORDER_SUCCESS = 'success';

    public static function getOrderStatusList(): array
    {
        return [
            self::ORDER_PENDING,
            self::ORDER_SUCCESS,
            self::ORDER_FAILED,
        ];
    }

    // generate random alphanumeric string
    public static function generateOrderName(): string
    {
        return Str::random(10);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(Orderitem::class);
    }
}
