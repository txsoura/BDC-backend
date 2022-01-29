<?php

namespace App\Services;

use App\Http\Requests\ConstructionUserStoreRequest;
use App\Http\Requests\ConstructionUserUpdateRequest;
use App\Models\ConstructionUser;
use App\Repositories\ConstructionUserRepository;
use App\Support\Traits\BaseConstructionCRUDMethodsService;
use Txsoura\Core\Services\CoreService;

class ConstructionUserService extends CoreService
{
    use BaseConstructionCRUDMethodsService;

    protected $storeRequest = ConstructionUserStoreRequest::class;
    protected $updateRequest = ConstructionUserUpdateRequest::class;

    /**
     * @var ConstructionUserRepository
     */
    protected $repository;

    /**
     * ConstructionUserService constructor.
     * @param ConstructionUserRepository $repository
     */
    public function __construct(ConstructionUserRepository $repository)
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
        return ConstructionUser::class;
    }

    /**
     * @param int $constructionId
     * @param int $companyId
     * @param int $userId
     * @return ConstructionUser|null
     */
    public function getByConstructionIdAndCompanyIdAndUserId(int $constructionId, int $companyId, int $userId): ?ConstructionUser
    {
        return $this->repository->getByConstructionIdAndCompanyIdAndUserId($constructionId, $companyId, $userId);
    }
}
