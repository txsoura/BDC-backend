<?php

namespace App\Models;

use App\Enums\ConstructionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Construction extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_date', 'end_date', 'status', 'budget', 'project'];

    protected $dates = ['start_date', 'end_date', 'canceled_at', 'started_at', 'finalized_at', 'abandoned_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'canceled_at' => 'datetime',
        'started_at' => 'datetime',
        'finalized_at' => 'datetime',
        'abandoned_at' => 'datetime',
        'budget' => 'decimal:2',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => ConstructionStatus::PENDENT,
        'budget' => '0.00',
    ];
}
