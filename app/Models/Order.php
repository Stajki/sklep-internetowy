<?php

namespace App\Models;

use App\Casts\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $casts = [
        'total_price_nett' => Money::class,
        'total_price_gross' => Money::class,
    ];

    protected $fillable = [
        'order_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
