<?php

namespace App\Models;

use App\Enums\CompanyStatus;
use Database\Factories\CompanyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $tax
 * @property string $type
 * @property string $workspace
 * @property int|null $cellphone
 * @property string $email
 * @property string|null $street
 * @property string|null $postcode
 * @property string|null $number
 * @property string|null $complement
 * @property string|null $district
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read Collection|CompanyUser[] $users
 * @property-read int|null $users_count
 * @method static CompanyFactory factory(...$parameters)
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static \Illuminate\Database\Query\Builder|Company onlyTrashed()
 * @method static Builder|Company query()
 * @method static Builder|Company whereCellphone($value)
 * @method static Builder|Company whereCity($value)
 * @method static Builder|Company whereComplement($value)
 * @method static Builder|Company whereCountry($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereDeletedAt($value)
 * @method static Builder|Company whereDistrict($value)
 * @method static Builder|Company whereEmail($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company whereNumber($value)
 * @method static Builder|Company wherePostcode($value)
 * @method static Builder|Company whereState($value)
 * @method static Builder|Company whereStatus($value)
 * @method static Builder|Company whereStreet($value)
 * @method static Builder|Company whereTax($value)
 * @method static Builder|Company whereType($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @method static Builder|Company whereWorkspace($value)
 * @method static \Illuminate\Database\Query\Builder|Company withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Company withoutTrashed()
 * @mixin Eloquent
 */
class Company extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'tax', 'type', 'workspace', 'cellphone', 'email', 'street', 'postcode', 'number', 'complement', 'city', 'state', 'country', 'district'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => CompanyStatus::PENDENT
    ];

    public function users()
    {
        return $this->hasMany(CompanyUser::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
