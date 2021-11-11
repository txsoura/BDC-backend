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
     * @param int $stock
     * @return JsonResponse
     */
    public function forceDestroy(Construction $construction, Product $product, int $stock): JsonResponse
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if (!$this->service->forceDestroy($stock, $construction->id, $product->id)) {
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
     * @param int $stock
     * @return JsonResponse
     */
    public function restore(Construction $construction, Product $product, int $stock): JsonResponse
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if (!$this->service->restore($stock, $construction->id, $product->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    /**
     * Update the stock status to received.
     *
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse|StockResource
     */
    public function receive(Construction $construction, Product $product, Stock $stock)
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }

        if ($stock->flow != StockFlow::IN) {
            return response()->json([
                'message' => trans('stock.receive.message'),
                'error' => trans('stock.receive.flow.error')
            ], 400);
        }

        if ($stock->status != StockStatus::PENDENT) {
            return response()->json([
                'message' => trans('stock.receive.message'),
                'error' => trans('stock.receive.status.error')
            ], 400);
        }

        $stock = $this->service
            ->receive($stock);

        if (!$stock) {
            return response()->json([
                'message' => trans('stock.receive_failed')
            ], 400);
        }

        return (new StockResource($stock))
            ->additional(['message' => trans('stock.received')]);
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
     * Update the stock status to withdrawn.
     *
     * @param Request $request
     * @param Construction $construction
     * @param Product $product
     * @param Stock $stock
     * @return JsonResponse|StockResource
     */
    public function withdraw(Request $request, Construction $construction, Product $product, Stock $stock)
    {
        if ($construction->id != $product->construction_id) {
            throw (new ModelNotFoundException())->setModel(Product::Class);
        }

        if ($product->id != $stock->product_id) {
            throw (new ModelNotFoundException())->setModel(Stock::Class);
        }

        if ($stock->flow != StockFlow::OUT) {
            return response()->json([
                'message' => trans('stock.withdraw.message'),
                'error' => trans('stock.withdraw.flow.error')
            ], 400);
        }

        if ($stock->status != StockStatus::PENDENT) {
            return response()->json([
                'message' => trans('stock.withdraw.message'),
                'error' => trans('stock.withdraw.status.error')
            ], 400);
        }

        $request->validate([
            'receiver' => 'required|string',
        ]);

        $stock = $this->service
            ->withdraw($stock, $request['receiver']);

        if (!$stock) {
            return response()->json([
                'message' => trans('stock.withdraw_failed')
            ], 400);
        }

        return (new StockResource($stock))
            ->additional(['message' => trans('stock.withdrawn')]);
    }
}
