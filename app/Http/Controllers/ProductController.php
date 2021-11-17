<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use App\Support\Traits\BaseConstructionCRUDMethodsController;

class ProductController extends Controller
{
    use BaseConstructionCRUDMethodsController;

    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * @var ProductResource
     */
    protected $resource = ProductResource::class;

    /**
     * @var ProductService
     */
    protected $service;

    /**
     * ProductController constructor.
     */
    public function __construct(ProductService $service, ProductRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }
}
