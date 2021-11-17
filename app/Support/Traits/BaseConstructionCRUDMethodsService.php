<?php

namespace App\Support\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Http\Requests\QueryParamsRequest;

trait BaseConstructionCRUDMethodsService
{
    protected $queryParamsRequest = QueryParamsRequest::class;

    public function index()
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->all();
    }

    public function store()
    {
        $this->request = resolve($this->storeRequest);

        try {
            return $this->model()::create($this->request->validated());
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public function show($id, $constructionId)
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->findOrFail($id, $constructionId);
    }

    public function update($id, $constructionId)
    {
        $this->request = resolve($this->updateRequest);

        $model = $this->repository->findOrFail($id, $constructionId);

        try {
            $model->update($this->request->validated());

            return $model;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public function destroy($id, $constructionId)
    {
        $model = $this->repository->findOrFail($id, $constructionId);

        try {
            $model->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public function forceDestroy($id, $constructionId)
    {
        $model = $this->repository->findOrFailWithTrashed($id, $constructionId);

        try {
            $model->forceDelete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public function restore($id, $constructionId)
    {
        $model = $this->repository->findOrFailWithTrashed($id, $constructionId);

        try {
            $model->restore();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
