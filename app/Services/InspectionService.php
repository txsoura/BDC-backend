<?php

namespace App\Services;

use App\Http\Requests\InspectionStoreRequest;
use App\Http\Requests\InspectionUpdateRequest;
use App\Models\Inspection;
use App\Repositories\InspectionRepository;
use App\Support\Traits\BaseConstructionCRUDMethodsService;
use Txsoura\Core\Services\CoreService;

class InspectionService extends CoreService
{
    use BaseConstructionCRUDMethodsService;

    protected $storeRequest = InspectionStoreRequest::class;
    protected $updateRequest = InspectionUpdateRequest::class;

    /**
     * @var InspectionRepository
     */
    protected $repository;

    /**
     * InspectionService constructor.
     * @param InspectionRepository $repository
     */
    public function __construct(InspectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Model class for crud.
     *
     * @return string
     */
    protected function model(): string
    {
        return Inspection::class;
    }
}
