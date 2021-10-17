<?php

namespace App\Services;

use App\Http\Requests\ProviderStoreRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use App\Support\Traits\BaseConstructionCRUDMethodsService;
use Txsoura\Core\Services\CoreService;

class ProviderService extends CoreService
{
    use BaseConstructionCRUDMethodsService;

    protected $storeRequest = ProviderStoreRequest::class;
    protected $updateRequest = ProviderUpdateRequest::class;

    /**
     * @var ProviderRepository
     */
    protected $repository;

    /**
     * ProviderService constructor.
     * @param ProviderRepository $repository
     */
    public function __construct(ProviderRepository $repository)
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
        return Provider::class;
    }
}
