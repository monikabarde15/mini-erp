<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>
    <h2>Sales Invoice</h2>
    <p>Order ID: {{ $order->id }}</p>
    <p>Customer: {{ $order->user->name }}</p>
    <p>Date: {{ $order->created_at->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ $item->price }}</td>
                    <td>₹{{ $item->quantity * $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: ₹{{ $order->total }}</h3>
</body>
</html>
