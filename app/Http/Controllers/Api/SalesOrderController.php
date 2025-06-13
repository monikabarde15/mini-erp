<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiSalesOrderRequest;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function show($id): JsonResponse
    {
        $order = SalesOrder::with('user','items.product')->findOrFail($id);

        return response()->json([
            'id'    => $order->id,
            'user'  => $order->user->only(['id','name','email']),
            'total' => $order->total,
            'items' => $order->items->map(/* … */),
        ], 200);
    }

    public function store(StoreApiSalesOrderRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            // ...calculate $total and $items as before

            $order = SalesOrder::create([
                'user_id' => $request->user()->id,
                'total'   => $total,
            ]);

            // ...create items and decrement stock

            DB::commit();

            return response()->json([
                'message'  => 'Order created successfully',
                'order_id' => $order->id
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
