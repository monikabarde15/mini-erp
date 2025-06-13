<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        h2, h4 { margin: 0; }
        .header, .footer { text-align: center; }
    </style>
</head>
<body>

<div class="header">
    <h2>Mini ERP Invoice</h2>
    <p><strong>Order #:</strong> {{ $order->id }}</p>
    <p><strong>Customer:</strong> {{ $order->user->name }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price (₹)</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price, 2) }}</td>
            <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4 style="text-align:right;">Total: ₹{{ number_format($order->total, 2) }}</h4>

<div class="footer">
    <p>Thank you for your business!</p>
</div>

</body>
</html>
