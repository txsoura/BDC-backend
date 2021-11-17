<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\SubscriptionStatus;
use Database\Factories\SubscriptionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property string $title
 * @property string $status
 * @property string $billing_method
 * @property Carbon $valid_until
 * @property mixed $amount
 * @property int $company_id
 * @property string $currency
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Company $company
 * @method static SubscriptionFactory factory(...$parameters)
 * @method static Builder|Subscription newModelQuery()
 * @method static Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subscription onlyTrashed()
 * @method static Builder|Subscription query()
 * @method static Builder|Subscription whereAmount($value)
 * @method static Builder|Subscription whereBillingMethod($value)
 * @method static Builder|Subscription whereCompanyId($value)
 * @method static Builder|Subscription whereCreatedAt($value)
 * @method static Builder|Subscription whereCurrency($value)
 * @method static Builder|Subscription whereDeletedAt($value)
 * @method static Builder|Subscription whereId($value)
 * @method static Builder|Subscription whereStatus($value)
 * @method static Builder|Subscription whereTitle($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @method static Builder|Subscription whereValidUntil($value)
 * @method static \Illuminate\Database\Query\Builder|Subscription withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subscription withoutTrashed()
 * @mixin Eloquent
 */
class Subscription extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'billing_method', 'valid_until', 'amount', 'company_id', 'currency'];

    protected $dates = ['valid_until'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'valid_until' => 'datetime',
        'amount' => 'decimal:2'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => SubscriptionStatus::PENDENT,
        'amount' => 0.00,
        'currency' => Currency::BRL
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
