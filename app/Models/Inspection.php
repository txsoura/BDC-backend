<?php

namespace App\Models;

use Database\Factories\InspectionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Inspection
 *
 * @property int $id
 * @property int $construction_id
 * @property string $seem
 * @property string|null $report
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Construction $construction
 * @method static InspectionFactory factory(...$parameters)
 * @method static Builder|Inspection newModelQuery()
 * @method static Builder|Inspection newQuery()
 * @method static \Illuminate\Database\Query\Builder|Inspection onlyTrashed()
 * @method static Builder|Inspection query()
 * @method static Builder|Inspection whereConstructionId($value)
 * @method static Builder|Inspection whereCreatedAt($value)
 * @method static Builder|Inspection whereDeletedAt($value)
 * @method static Builder|Inspection whereId($value)
 * @method static Builder|Inspection whereReport($value)
 * @method static Builder|Inspection whereSeem($value)
 * @method static Builder|Inspection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Inspection withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Inspection withoutTrashed()
 * @mixin Eloquent
 */
class Inspection extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['construction_id', 'seem', 'report'];

    public function construction()
    {
        return $this->belongsTo(Construction::class);
    }
}
