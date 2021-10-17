<?php

namespace App\Support\Traits;

use App\Models\Construction;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait BaseConstructionCRUDMethodsController
{
    public function index(Request $request, Construction $construction)
    {
        $request['construction_id'] = $construction->id;

        $models = $this->service
            ->setRequest($request)
            ->index();

        return $this->resource::collection($models);
    }

    public function store(Request $request, Construction $construction)
    {
        $request['construction_id'] = $construction->id;

        $model = $this->service
            ->setRequest($request)
            ->store();

        if (!$model) {
            return response()->json([
                'message' => trans('core::message.store_failed')
            ], 400);
        }

        return (new $this->resource($model))
            ->additional(['message' => trans('core::message.stored')]);
    }

    public function show(Request $request, Construction $construction)
    {
        $id = Arr::last(func_get_args());

        $model = $this->service
            ->setRequest($request)
            ->show($id, $construction->id);

        return new $this->resource($model, 200);
    }

    public function update(Request $request, Construction $construction)
    {
        $id = Arr::last(func_get_args());

        $model = $this->service
            ->setRequest($request)
            ->update($id, $construction->id);

        if (!$model) {
            return response()->json([
                'message' => trans('core::message.update_failed')
            ], 400);
        }

        return (new $this->resource($model))
            ->additional(['message' => trans('core::message.updated')]);
    }

    public function destroy(Request $request, Construction $construction)
    {
        $id = Arr::last(func_get_args());

        if (!$this->service->destroy($id, $construction->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    public function forceDestroy(Request $request, Construction $construction)
    {
        $id = Arr::last(func_get_args());

        if (!$this->service->forceDestroy($id, $construction->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    public function restore(Request $request, Construction $construction)
    {
        $id = Arr::last(func_get_args());

        if (!$this->service->restore($id, $construction->id)) {
            return response()->json([
                'message' => trans('core::message.restore_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.restored')
        ]);
    }
}
