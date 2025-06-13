<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller
{
    // GET /api/sales-orders/{id}
    public function show($id)
    {
        $order = SalesOrder::with('items.product')->findOrFail($id);
        return response()->json([
            'id' => $order->id,
            'total' => $order->total,
            'items' => $order->items->map(function ($item) {
                return [
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->quantity * $item->price,
                ];
            }),
        ]);
    }

    // POST /api/sales-orders
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $total = 0;
            $items = [];

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);
                $qty = $item['quantity'];

                if ($product->quantity < $qty) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $total += $product->price * $qty;
                $items[] = [
                    'product' => $product,
                    'quantity' => $qty,
                    'price' => $product->price
                ];
            }

            $order = SalesOrder::create([
                'user_id' => $request->user()->id,
                'total' => $total,
            ]);

            foreach ($items as $item) {
                SalesOrderItem::create([
                    'sales_order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Reduce stock
                $item['product']->decrement('quantity', $item['quantity']);
            }

            DB::commit();

            return response()->json(['message' => 'Order created successfully', 'order_id' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
