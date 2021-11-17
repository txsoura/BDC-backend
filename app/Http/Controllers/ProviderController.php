<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProviderResource;
use App\Repositories\ProviderRepository;
use App\Services\ProviderService;
use App\Support\Traits\BaseConstructionCRUDMethodsController;

class ProviderController extends Controller
{
    use BaseConstructionCRUDMethodsController;

    /**
     * @var ProviderRepository
     */
    protected $repository;

    /**
     * @var ProviderResource
     */
    protected $resource = ProviderResource::class;

    /**
     * @var ProviderService
     */
    protected $service;

    /**
     * ProviderController constructor.
     */
    public function __construct(ProviderService $service, ProviderRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }
}
