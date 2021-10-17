<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Txsoura\Core\Http\Controllers\Traits\CRUDMethodsController;
use Txsoura\Core\Http\Controllers\Traits\SoftDeleteMethodsController;

class UserController extends Controller
{
    use CRUDMethodsController, SoftDeleteMethodsController;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserResource
     */
    protected $resource = UserResource::class;

    /**
     * @var UserService
     */
    protected $service;

    /**
     * UserController constructor.
     */
    public function __construct(UserService $service, UserRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }


    /**
     * Update the user status to approved.
     *
     * @param User $user
     * @return JsonResponse|UserResource
     */
    public function approve(User $user)
    {
        $user = $this->service
            ->approve($user);

        if (!$user) {
            return response()->json([
                'message' => trans('user.approve_failed')
            ], 400);
        }

        return (new $this->resource($user))
            ->additional(['message' => trans('user.approved')]);
    }

    /**
     * Update the user status to blocked.
     *
     * @param User $user
     * @return JsonResponse|UserResource
     */
    public function block(User $user)
    {
        $user = $this->service
            ->block($user);

        if (!$user) {
            return response()->json([
                'message' => trans('user.block_failed')
            ], 400);
        }

        return (new $this->resource($user))
            ->additional(['message' => trans('user.blocked')]);
    }
}
