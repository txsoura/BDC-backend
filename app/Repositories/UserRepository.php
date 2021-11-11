<?php

namespace App\Repositories;

use App\Enums\UserStatus;
use App\Models\User;
use Txsoura\Core\Repositories\CoreRepository;
use Txsoura\Core\Repositories\Traits\SoftDeleteMethodsRepository;

class UserRepository extends CoreRepository
{
    use SoftDeleteMethodsRepository;

    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['companies', 'companies.company'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('email', 'status', 'name', 'role', 'lang');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('email', 'status', 'name', 'role', 'lang', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('email', 'name');

    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array('created_at', 'updated_at');

    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array();

    /**
     * @param User $user
     * @return User|null
     */
    public function approve(User $user): ?User
    {
        $user->status = UserStatus::APPROVED;
        $user->update();

        return $user;
    }

    /**
     * @param User $user
     * @return User|null
     */
    public function block(User $user): ?User
    {
        $user->status = UserStatus::BLOCKED;
        $user->update();

        return $user;
    }

    protected function model(): string
    {
        return User::class;
    }
}
