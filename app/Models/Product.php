<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $notify_when_stock_below
 * @property mixed $available
 * @property int $construction_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Construction $construction
 * @property-read Collection|Stock[] $stocks
 * @property-read int|null $stocks_count
 * @method static ProductFactory factory(...$parameters)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static Builder|Product query()
 * @method static Builder|Product whereAvailable($value)
 * @method static Builder|Product whereConstructionId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereNotifyWhenStockBelow($value)
 * @method static Builder|Product whereType($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin Eloquent
 */
class Product extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'notify_when_stock_below', 'available', 'construction_id'];

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

    public function construction()
    {
        return $this->belongsTo(Construction::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
