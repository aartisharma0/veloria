<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; color: #333; font-size: 14px; padding: 40px; }
        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; border-bottom: 3px solid #d63384; padding-bottom: 20px; }
        .brand { font-size: 28px; font-weight: 700; letter-spacing: 3px; color: #d63384; }
        .brand small { display: block; font-size: 11px; color: #888; letter-spacing: 1px; font-weight: 400; font-style: italic; }
        .invoice-title { text-align: right; }
        .invoice-title h2 { font-size: 22px; color: #333; margin-bottom: 5px; }
        .invoice-title p { color: #888; font-size: 12px; }
        .info-grid { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .info-box { flex: 1; }
        .info-box h4 { font-size: 12px; text-transform: uppercase; color: #d63384; letter-spacing: 1px; margin-bottom: 8px; }
        .info-box p { font-size: 13px; line-height: 1.6; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        thead th { background: #f8f8f8; padding: 12px 15px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #666; border-bottom: 2px solid #eee; }
        tbody td { padding: 12px 15px; border-bottom: 1px solid #f0f0f0; }
        .text-right { text-align: right; }
        .totals { margin-left: auto; width: 280px; }
        .totals tr td { padding: 6px 0; font-size: 13px; }
        .totals .total-row { font-size: 18px; font-weight: 700; color: #d63384; border-top: 2px solid #d63384; padding-top: 10px; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; color: #aaa; font-size: 11px; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        @media print { body { padding: 20px; } .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:center;margin-bottom:20px;">
        <button onclick="window.print()" style="background:#d63384;color:white;border:none;padding:10px 30px;border-radius:8px;cursor:pointer;font-weight:600;">
            <span style="margin-right:5px;">&#128438;</span> Print / Download PDF
        </button>
        <button onclick="window.close()" style="background:#6c757d;color:white;border:none;padding:10px 30px;border-radius:8px;cursor:pointer;font-weight:600;margin-left:10px;">Close</button>
    </div>

    <div class="invoice-header">
        <div>
            <div class="brand">VELORIA<small>Where every piece tells your story</small></div>
        </div>
        <div class="invoice-title">
            <h2>INVOICE</h2>
            <p><strong>{{ $order->order_number }}</strong></p>
            <p>Date: {{ $order->created_at->format('M d, Y') }}</p>
            <p>
                @php
                    $statusBadge = match($order->status) {
                        'processing' => 'badge-info',
                        'shipped' => 'badge-info',
                        'delivered' => 'badge-success',
                        'cancelled' => 'badge-warning',
                        default => 'badge-warning',
                    };
                @endphp
                <span class="badge {{ $statusBadge }}">{{ strtoupper($order->status) }}</span>
                @if($order->payment && $order->payment->status === 'completed')
                    <span class="badge badge-success">PAID</span>
                @endif
            </p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <h4>Bill To</h4>
            <p>
                <strong>{{ $order->user->name }}</strong><br>
                {{ $order->user->email }}<br>
                @if($order->user->phone){{ $order->user->phone }}<br>@endif
            </p>
        </div>
        @if($order->shippingAddress)
        <div class="info-box">
            <h4>Ship To</h4>
            <p>
                <strong>{{ $order->shippingAddress->full_name }}</strong><br>
                {{ $order->shippingAddress->street }}<br>
                {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->zip }}<br>
                {{ $order->shippingAddress->country }}<br>
                @if($order->shippingAddress->phone)Phone: {{ $order->shippingAddress->phone }}@endif
            </p>
        </div>
        @endif
        <div class="info-box">
            <h4>Payment</h4>
            <p>
                Method: {{ strtoupper($order->payment_method) }}<br>
                @if($order->payment && $order->payment->transaction_id)
                    Txn ID: {{ $order->payment->transaction_id }}<br>
                @endif
                @if($order->payment && $order->payment->paid_at)
                    Paid: {{ $order->payment->paid_at->format('M d, Y h:i A') }}
                @endif
            </p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Variant</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $item->product->name ?? 'Product' }}</strong></td>
                <td>{{ $item->variant ? $item->variant->size . ' / ' . $item->variant->color : '—' }}</td>
                <td class="text-right">&#8377;{{ number_format($item->unit_price, 2) }}</td>
                <td class="text-right">{{ $item->qty }}</td>
                <td class="text-right"><strong>&#8377;{{ number_format($item->total, 2) }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr><td>Subtotal</td><td class="text-right">&#8377;{{ number_format($order->subtotal, 2) }}</td></tr>
        @if($order->discount > 0)
        <tr style="color:#28a745;"><td>Discount</td><td class="text-right">-&#8377;{{ number_format($order->discount, 2) }}</td></tr>
        @endif
        <tr><td>Tax (GST 18%)</td><td class="text-right">&#8377;{{ number_format($order->tax, 2) }}</td></tr>
        <tr><td>Shipping</td><td class="text-right">{{ $order->shipping_cost > 0 ? '₹'.number_format($order->shipping_cost, 2) : 'FREE' }}</td></tr>
        <tr class="total-row"><td><strong>Grand Total</strong></td><td class="text-right"><strong>&#8377;{{ number_format($order->total, 2) }}</strong></td></tr>
    </table>

    <div class="footer">
        <p><strong>VELORIA</strong> — Where every piece tells your story</p>
        <p>Thank you for shopping with us! For queries, contact support@veloria.com</p>
        <p>This is a computer-generated invoice. No signature required.</p>
    </div>
</body>
</html>
