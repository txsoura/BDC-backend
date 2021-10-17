<?php

namespace App\Models;

use App\Enums\ConstructionStatus;
use Database\Factories\ConstructionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Construction
 *
 * @property int $id
 * @property string $name
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string $status
 * @property mixed $budget
 * @property string|null $project
 * @property Carbon|null $canceled_at
 * @property Carbon|null $started_at
 * @property Carbon|null $finalized_at
 * @property Carbon|null $abandoned_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Inspection[] $inspections
 * @property-read int|null $inspections_count
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read Collection|Provider[] $providers
 * @property-read int|null $providers_count
 * @property-read Collection|Stage[] $stages
 * @property-read int|null $stages_count
 * @property-read Collection|Stock[] $stocks
 * @property-read int|null $stocks_count
 * @property-read Collection|ConstructionUser[] $users
 * @property-read int|null $users_count
 * @method static ConstructionFactory factory(...$parameters)
 * @method static Builder|Construction newModelQuery()
 * @method static Builder|Construction newQuery()
 * @method static \Illuminate\Database\Query\Builder|Construction onlyTrashed()
 * @method static Builder|Construction query()
 * @method static Builder|Construction whereAbandonedAt($value)
 * @method static Builder|Construction whereBudget($value)
 * @method static Builder|Construction whereCanceledAt($value)
 * @method static Builder|Construction whereCreatedAt($value)
 * @method static Builder|Construction whereDeletedAt($value)
 * @method static Builder|Construction whereEndDate($value)
 * @method static Builder|Construction whereFinalizedAt($value)
 * @method static Builder|Construction whereId($value)
 * @method static Builder|Construction whereName($value)
 * @method static Builder|Construction whereProject($value)
 * @method static Builder|Construction whereStartDate($value)
 * @method static Builder|Construction whereStartedAt($value)
 * @method static Builder|Construction whereStatus($value)
 * @method static Builder|Construction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Construction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Construction withoutTrashed()
 * @mixin Eloquent
 */
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

    public function users()
    {
        return $this->hasMany(ConstructionUser::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
