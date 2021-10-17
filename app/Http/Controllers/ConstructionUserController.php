<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConstructionUserResource;
use App\Repositories\ConstructionUserRepository;
use App\Services\ConstructionUserService;
use App\Support\Traits\BaseConstructionCRUDMethodsController;

class ConstructionUserController extends Controller
{
    use BaseConstructionCRUDMethodsController;

    /**
     * @var ConstructionUserRepository
     */
    protected $repository;

    /**
     * @var ConstructionUserResource
     */
    protected $resource = ConstructionUserResource::class;

    /**
     * @var ConstructionUserService
     */
    protected $service;

    /**
     * ConstructionUserController constructor.
     */
    public function __construct(ConstructionUserService $service, ConstructionUserRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }
}
