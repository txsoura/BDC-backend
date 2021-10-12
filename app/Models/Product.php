<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'notify_when_stock_below', 'available',];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'notify_when_stock_below' => 'integer',
        'available' => 'decimal:2'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'notify_when_stock_below' => '0',
        'available' => '0.00'
    ];
}
