<?php 
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSalesOrderRequest;


class SalesOrderController extends Controller
{
    public function index()
    {
        $orders = SalesOrder::with('user')->orderBy('created_at', 'desc')->get();
        return view('sales-orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales-orders.create', compact('products'));
    }

   public function store(StoreSalesOrderRequest $request)
    {
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

                $subtotal = $product->price * $qty;
                $total += $subtotal;

                $items[] = [
                    'product_id' => $product->id,
                    'quantity'   => $qty,
                    'price'      => $product->price,
                ];
            }

            $order = SalesOrder::create([
                'user_id' => auth()->id(),
                'total'   => $total,
            ]);

            foreach ($items as $item) {
                SalesOrderItem::create([
                    'sales_order_id' => $order->id,
                    ...$item
                ]);

                Product::where('id', $item['product_id'])->decrement('quantity', $item['quantity']);
            }

            DB::commit();
            return redirect()->route('sales-orders.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        $order = SalesOrder::with('items.product', 'user')->findOrFail($id);
        return view('sales-orders.show', compact('order'));
    }

    public function exportPdf($id)
    {
        $order = SalesOrder::with('items.product', 'user')->findOrFail($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download("invoice_{$order->id}.pdf");
    }
}
