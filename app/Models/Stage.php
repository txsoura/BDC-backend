<?php

namespace App\Models;

use Database\Factories\StageFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Stage
 *
 * @property int $id
 * @property string $name
 * @property int $construction_id
 * @property mixed $budget
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Construction $construction
 * @method static StageFactory factory(...$parameters)
 * @method static Builder|Stage newModelQuery()
 * @method static Builder|Stage newQuery()
 * @method static \Illuminate\Database\Query\Builder|Stage onlyTrashed()
 * @method static Builder|Stage query()
 * @method static Builder|Stage whereBudget($value)
 * @method static Builder|Stage whereConstructionId($value)
 * @method static Builder|Stage whereCreatedAt($value)
 * @method static Builder|Stage whereDeletedAt($value)
 * @method static Builder|Stage whereId($value)
 * @method static Builder|Stage whereName($value)
 * @method static Builder|Stage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Stage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Stage withoutTrashed()
 * @mixin Eloquent
 */
class Stage extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'construction_id', 'budget'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'budget' => 'decimal:2',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'budget' => '0.00',
    ];

    public function construction()
    {
        return $this->belongsTo(Construction::class);
    }
}
