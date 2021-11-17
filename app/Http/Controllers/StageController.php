<?php

namespace App\Http\Controllers;

use App\Http\Resources\StageResource;
use App\Repositories\StageRepository;
use App\Services\StageService;
use App\Support\Traits\BaseConstructionCRUDMethodsController;

class StageController extends Controller
{
    use BaseConstructionCRUDMethodsController;

    /**
     * @var StageRepository
     */
    protected $repository;

    /**
     * @var StageResource
     */
    protected $resource = StageResource::class;

    /**
     * @var StageService
     */
    protected $service;

    /**
     * StageController constructor.
     */
    public function __construct(StageService $service, StageRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }
}
