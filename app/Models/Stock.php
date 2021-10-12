<?php

namespace App\Models;

use App\Enums\StockStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quantity', 'price', 'construction_id', 'provider_id', 'product_id', 'flow', 'status', 'outgoing_receiver', 'receipt'];

    protected $dates = ['canceled_at', 'arrived_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'decimal:2',
        'price' => 'decimal:2',
        'canceled_at' => 'datetime',
        'arrived_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'quantity' => '0.00',
        'price' => '0.00',
        'status' => StockStatus::PENDENT
    ];
}
