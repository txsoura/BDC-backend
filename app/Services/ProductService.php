<?php

namespace App\Services;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Support\Traits\BaseConstructionCRUDMethodsService;
use Txsoura\Core\Services\CoreService;

class ProductService extends CoreService
{
    use BaseConstructionCRUDMethodsService;

    protected $storeRequest = ProductStoreRequest::class;
    protected $updateRequest = ProductUpdateRequest::class;

    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
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
        return Product::class;
    }
}
