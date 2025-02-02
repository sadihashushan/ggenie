<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function downloadInvoice(Order $order)
    {
        $pdf = Pdf::loadView('invoices.invoice-pdf', compact('order'));

        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
}
