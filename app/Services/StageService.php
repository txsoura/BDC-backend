<?php

namespace App\Services;

use App\Http\Requests\StageStoreRequest;
use App\Http\Requests\StageUpdateRequest;
use App\Models\Stage;
use App\Repositories\StageRepository;
use App\Support\Traits\BaseConstructionCRUDMethodsService;
use Txsoura\Core\Services\CoreService;

class StageService extends CoreService
{
    use BaseConstructionCRUDMethodsService;

    protected $storeRequest = StageStoreRequest::class;
    protected $updateRequest = StageUpdateRequest::class;

    /**
     * @var StageRepository
     */
    protected $repository;

    /**
     * StageService constructor.
     * @param StageRepository $repository
     */
    public function __construct(StageRepository $repository)
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
        return Stage::class;
    }
}
