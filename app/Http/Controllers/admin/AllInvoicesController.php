<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllInvoicesController extends Controller
{
    /**
     * Display a listing of all invoices across all companies.
     */
    public function index(Request $request)
    {
        $query = Invoice::with(['client', 'package'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        // Filter by company
        if ($request->filled('company_id')) {
            $query->where('client_id', $request->company_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('issue_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('issue_date', '<=', $request->date_to);
        }

        // Search by invoice ID or company name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($clientQuery) use ($search) {
                      $clientQuery->where('company_name_en', 'like', "%{$search}%")
                                 ->orWhere('company_name_ar', 'like', "%{$search}%");
                  });
            });
        }

        $invoices = $query->paginate(20)->withQueryString();

        // Get companies for filter dropdown
        $companies = Company::orderBy('company_name_en')->get();

        // Get statistics (excluding cancelled invoices)
        $totalAmount = Invoice::where('payment_status', '!=', 'cancelled')->sum('amount');
        $paidAmount = Invoice::where('payment_status', '!=', 'cancelled')
            ->with('payments')
            ->get()
            ->sum(function ($invoice) {
                return $invoice->payments->sum('amount');
            });
        $remainingAmount = $totalAmount - $paidAmount;
        
        $stats = [
            'total_invoices' => Invoice::count(),
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'remaining_amount' => $remainingAmount,
            'paid_invoices' => Invoice::where('payment_status', 'paid')->count(),
            'pending_invoices' => Invoice::where('payment_status', 'pending')->count(),
            'overdue_invoices' => Invoice::where('payment_status', 'overdue')->count(),
            'partially_paid_invoices' => Invoice::where('payment_status', 'partially_paid')->count(),
            'cancelled_invoices' => Invoice::where('payment_status', 'cancelled')->count(),
        ];

        return view('admin.invoices.index', compact('invoices', 'companies', 'stats'));
    }

    /**
     * Show the specified invoice.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['client', 'package', 'payments.createdBy']);
        
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Download the specified invoice as PDF.
     */
    public function download(Invoice $invoice)
    {
        $invoice->load(['client', 'package']);

        // Initialize mPDF with Arabic support
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'tempDir' => storage_path('app/temp'),
        ]);

        // Set font for Arabic support
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        // Generate HTML content
        $html = view('admin.companies.invoices.pdf', [
            'company' => $invoice->client,
            'invoice' => $invoice,
        ])->render();

        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        $fileName = 'invoice-' . $invoice->id . '.pdf';

        // Output PDF
        return response($mpdf->Output($fileName, 'D'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}