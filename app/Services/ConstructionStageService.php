<?php

namespace App\Services;

use App\Http\Requests\ConstructionStageStoreRequest;
use App\Http\Requests\ConstructionStageUpdateRequest;
use App\Models\ConstructionStage;
use App\Repositories\ConstructionStageRepository;
use Txsoura\Core\Services\CoreService;
use Txsoura\Core\Services\Traits\CRUDMethodsService;
use Txsoura\Core\Services\Traits\SoftDeleteMethodsService;

class ConstructionStageService extends CoreService
{
    use CRUDMethodsService, SoftDeleteMethodsService;

    protected $storeRequest = ConstructionStageStoreRequest::class;
    protected $updateRequest = ConstructionStageUpdateRequest::class;

    /**
     * @var ConstructionStageRepository
     */
    protected $repository;

    /**
     * ConstructionStageService constructor.
     * @param ConstructionStageRepository $repository
     */
    public function __construct(ConstructionStageRepository $repository)
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
        return ConstructionStage::class;
    }
}
