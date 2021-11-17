<?php

namespace App\Models;

use Database\Factories\ProviderFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Provider
 *
 * @property int $id
 * @property string $name
 * @property int $construction_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Construction $construction
 * @property-read Collection|Stock[] $stocks
 * @property-read int|null $stocks_count
 * @method static ProviderFactory factory(...$parameters)
 * @method static Builder|Provider newModelQuery()
 * @method static Builder|Provider newQuery()
 * @method static \Illuminate\Database\Query\Builder|Provider onlyTrashed()
 * @method static Builder|Provider query()
 * @method static Builder|Provider whereConstructionId($value)
 * @method static Builder|Provider whereCreatedAt($value)
 * @method static Builder|Provider whereDeletedAt($value)
 * @method static Builder|Provider whereId($value)
 * @method static Builder|Provider whereName($value)
 * @method static Builder|Provider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Provider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Provider withoutTrashed()
 * @mixin Eloquent
 */
class Provider extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'construction_id'];

    public function construction()
    {
        return $this->belongsTo(Construction::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
