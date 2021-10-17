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

    public function show($id, $construction_id)
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->findOrFail($id, $construction_id);
    }

    public function update($id, $construction_id)
    {
        $this->request = resolve($this->updateRequest);

        $model = $this->repository->findOrFail($id, $construction_id);

        try {
            $model->update($this->request->validated());

            return $model;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public function destroy($id, $construction_id)
    {
        $model = $this->repository->findOrFail($id, $construction_id);

        try {
            $model->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public function forceDestroy($id, $construction_id)
    {
        $model = $this->model()::withTrashed()
            ->whereId($id)
            ->whereConstructionId($construction_id)
            ->firstOrFail();

        try {
            $model->forceDelete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    public function restore($id, $construction_id)
    {
        $model = $this->model()::withTrashed()
            ->whereId($id)
            ->whereConstructionId($construction_id)
            ->firstOrFail();

        try {
            $model->restore();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
