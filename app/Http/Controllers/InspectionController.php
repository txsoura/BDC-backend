<?php

namespace App\Http\Controllers;

use App\Http\Resources\InspectionResource;
use App\Repositories\InspectionRepository;
use App\Services\InspectionService;
use App\Support\Traits\BaseConstructionCRUDMethodsController;

class InspectionController extends Controller
{
    use BaseConstructionCRUDMethodsController;

    /**
     * @var InspectionRepository
     */
    protected $repository;

    /**
     * @var InspectionResource
     */
    protected $resource = InspectionResource::class;

    /**
     * @var InspectionService
     */
    protected $service;

    /**
     * InspectionController constructor.
     */
    public function __construct(InspectionService $service, InspectionRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }
}
