<?php

namespace App\Services;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Services\CoreService;
use Txsoura\Core\Services\Traits\CRUDMethodsService;
use Txsoura\Core\Services\Traits\SoftDeleteMethodsService;

class UserService extends CoreService
{
    use CRUDMethodsService, SoftDeleteMethodsService;

    protected $storeRequest = UserStoreRequest::class;
    protected $updateRequest = UserUpdateRequest::class;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     * @return User|false
     */
    public function approve(User $user)
    {
        try {
            return $this->repository->approve($user);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param User $user
     * @return User|false
     */
    public function block(User $user)
    {
        try {
            return $this->repository->block($user);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Model class for crud.
     *
     * @return string
     */
    protected function model(): string
    {
        return User::class;
    }
}
