<?php

namespace App\Models;

use App\Enums\ConstructionUserRole;
use Database\Factories\ConstructionUserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ConstructionUser
 *
 * @property int $id
 * @property string $role
 * @property int $user_id
 * @property int $construction_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Construction $construction
 * @property-read User $user
 * @method static ConstructionUserFactory factory(...$parameters)
 * @method static Builder|ConstructionUser newModelQuery()
 * @method static Builder|ConstructionUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|ConstructionUser onlyTrashed()
 * @method static Builder|ConstructionUser query()
 * @method static Builder|ConstructionUser whereConstructionId($value)
 * @method static Builder|ConstructionUser whereCreatedAt($value)
 * @method static Builder|ConstructionUser whereDeletedAt($value)
 * @method static Builder|ConstructionUser whereId($value)
 * @method static Builder|ConstructionUser whereRole($value)
 * @method static Builder|ConstructionUser whereUpdatedAt($value)
 * @method static Builder|ConstructionUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ConstructionUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ConstructionUser withoutTrashed()
 * @mixin Eloquent
 */
class ConstructionUser extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role', 'user_id', 'construction_id'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role' => ConstructionUserRole::OWNER
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function construction()
    {
        return $this->belongsTo(Construction::class);
    }
}
