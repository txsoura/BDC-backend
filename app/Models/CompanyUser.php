<?php

namespace App\Models;

use App\Enums\CompanyUserRole;
use Database\Factories\CompanyUserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\CompanyUser
 *
 * @property int $id
 * @property string $role
 * @property int $user_id
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Company $company
 * @property-read User $user
 * @method static CompanyUserFactory factory(...$parameters)
 * @method static Builder|CompanyUser newModelQuery()
 * @method static Builder|CompanyUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|CompanyUser onlyTrashed()
 * @method static Builder|CompanyUser query()
 * @method static Builder|CompanyUser whereCompanyId($value)
 * @method static Builder|CompanyUser whereCreatedAt($value)
 * @method static Builder|CompanyUser whereDeletedAt($value)
 * @method static Builder|CompanyUser whereId($value)
 * @method static Builder|CompanyUser whereRole($value)
 * @method static Builder|CompanyUser whereUpdatedAt($value)
 * @method static Builder|CompanyUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|CompanyUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CompanyUser withoutTrashed()
 * @mixin Eloquent
 */
class CompanyUser extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role', 'company_id', 'user_id'];


    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role' => CompanyUserRole::MEMBER
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
