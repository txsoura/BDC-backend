<?php

namespace App\Http\Controllers;

use App\Enums\StockFlow;
use App\Enums\StockStatus;
use App\Http\Resources\StockResource;
use App\Models\Construction;
use App\Models\Product;
use App\Models\Stock;
use App\Services\StockService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StockController extends Controller
{
    /**
     * @var StockService
     */
    protected $service;

    /**
     * StockController constructor.
     */
    public function __construct(StockService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Construction $construction
     * @param Product $product
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, Construction $construction, Product $product): AnonymousResourceCollection
    {
        $request['construction_id'] = $construction->id;
        $request['product_id'] = $product->id;

        $stocks = $this->service
            ->setRequest($request)
            ->index();

        return StockResource::collection($stocks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Construction $construction
     * @param Product $product
     * @return StockResource|JsonResponse
     */
    public function store(Request $request, Construction $construction, Product $product)
    {
        $request['construction_id'] = $construction->id;
        $request['product_id'] = $product->id;

        $stock = $this->service
            ->setRequest($request)
            ->store();

        if (!$stock) {
            return response()->json([
                'message' => trans('core::message.store_failed')
            ], 400);
        }

        return (new StockResource($stock))
            ->additional(['message' => trans('core::message.stored')]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return StockResource
     */
    public function show(Request $request, Construction $construction, Product $product, Stock $stock): StockResource
    {
        $stock = $this->service
            ->setRequest($request)
            ->show($stock->id, $construction->id, $product->id);

        return new StockResource($stock);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse
     */
    public function destroy(Construction $construction, Product $product, Stock $stock): JsonResponse
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }


        if (!$this->service->destroy($stock->id, $construction->id, $product->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse
     */
    public function forceDestroy(Construction $construction, Product $product, Stock $stock): JsonResponse
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }

        if (!$this->service->forceDestroy($stock->id, $construction->id, $product->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse
     */
    public function restore(Construction $construction, Product $product, Stock $stock): JsonResponse
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }

        if (!$this->service->restore($stock->id, $construction->id, $product->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    /**
     * Update the stock status to arrived.
     *
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse|StockResource
     */
    public function arrive(Construction $construction, Product $product, Stock $stock)
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }

        if ($stock->flow != StockFlow::IN) {
            return response()->json([
                'message' => trans('stock.arrive.message'),
                'error' => trans('stock.arrive.flow.error')
            ], 400);
        }

        if ($stock->status != StockStatus::PENDENT) {
            return response()->json([
                'message' => trans('stock.arrive.message'),
                'error' => trans('stock.arrive.status.error')
            ], 400);
        }

        $stock = $this->service
            ->arrive($stock);

        if (!$stock) {
            return response()->json([
                'message' => trans('stock.arrive_failed')
            ], 400);
        }

        return (new StockResource($stock))
            ->additional(['message' => trans('stock.arrived')]);
    }

    /**
     * Update the stock status to canceled.
     *
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse|StockResource
     */
    public function cancel(Construction $construction, Product $product, Stock $stock)
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }

        if ($stock->status != StockStatus::PENDENT) {
            return response()->json([
                'message' => trans('stock.cancel.message'),
                'error' => trans('stock.cancel.status.error')
            ], 400);
        }

        $stock = $this->service
            ->cancel($stock);

        if (!$stock) {
            return response()->json([
                'message' => trans('stock.cancel_failed')
            ], 400);
        }

        return (new StockResource($stock))
            ->additional(['message' => trans('stock.canceled')]);
    }

    /**
     * Update the stock status to outgoing.
     *
     * @param Request $request
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse|StockResource
     */
    public function outgoing(Request $request, Construction $construction, Product $product, Stock $stock)
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }

        if ($stock->flow != StockFlow::OUT) {
            return response()->json([
                'message' => trans('stock.outgoing.message'),
                'error' => trans('stock.outgoing.flow.error')
            ], 400);
        }

        if ($stock->status != StockStatus::PENDENT) {
            return response()->json([
                'message' => trans('stock.outgoing.message'),
                'error' => trans('stock.outgoing.status.error')
            ], 400);
        }

        $request->validate([
            'receiver' => 'required|string',
        ]);

        $stock = $this->service
            ->outgoing($stock, $request['receiver']);

        if (!$stock) {
            return response()->json([
                'message' => trans('stock.outgoing_failed')
            ], 400);
        }

        return (new StockResource($stock))
            ->additional(['message' => trans('stock.outgoing')]);
    }
}
