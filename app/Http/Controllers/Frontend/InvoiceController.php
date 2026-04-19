<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        if ($order->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Refresh from DB to get latest status
        $order->refresh();
        $order->load(['items.product', 'user', 'shippingAddress', 'payment']);

        // Generate HTML invoice and convert to downloadable HTML
        $html = view('frontend.invoice.pdf', compact('order'))->render();

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="Veloria-Invoice-' . $order->order_number . '.html"');
    }
}
