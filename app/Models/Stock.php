<?php

namespace App\Models;

use App\Enums\StockStatus;
use Database\Factories\StockFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Stock
 *
 * @property int $id
 * @property mixed $quantity
 * @property mixed $price
 * @property int $construction_id
 * @property int $provider_id
 * @property int $product_id
 * @property string $flow
 * @property string $status
 * @property string|null $outgoing_receiver
 * @property string|null $receipt
 * @property Carbon|null $canceled_at
 * @property Carbon|null $received_at
 * @property Carbon|null $withdrawn_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Construction $construction
 * @property-read Product $product
 * @property-read Provider $provider
 * @method static StockFactory factory(...$parameters)
 * @method static Builder|Stock newModelQuery()
 * @method static Builder|Stock newQuery()
 * @method static \Illuminate\Database\Query\Builder|Stock onlyTrashed()
 * @method static Builder|Stock query()
 * @method static Builder|Stock whereReceivedAt($value)
 * @method static Builder|Stock whereCanceledAt($value)
 * @method static Builder|Stock whereConstructionId($value)
 * @method static Builder|Stock whereCreatedAt($value)
 * @method static Builder|Stock whereDeletedAt($value)
 * @method static Builder|Stock whereFlow($value)
 * @method static Builder|Stock whereId($value)
 * @method static Builder|Stock whereWithdrawnAt($value)
 * @method static Builder|Stock whereOutgoingReceiver($value)
 * @method static Builder|Stock wherePrice($value)
 * @method static Builder|Stock whereProductId($value)
 * @method static Builder|Stock whereProviderId($value)
 * @method static Builder|Stock whereQuantity($value)
 * @method static Builder|Stock whereReceipt($value)
 * @method static Builder|Stock whereStatus($value)
 * @method static Builder|Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Stock withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Stock withoutTrashed()
 * @mixin Eloquent
 */
class Stock extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quantity', 'price', 'construction_id', 'provider_id', 'product_id', 'flow', 'outgoing_receiver', 'receipt'];

    protected $dates = ['withdrawn_at', 'canceled_at', 'received_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'decimal:2',
        'price' => 'decimal:2',
        'canceled_at' => 'datetime',
        'received_at' => 'datetime',
        'withdrawn_at' => 'datetime',
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

    public function construction()
    {
        return $this->belongsTo(Construction::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
