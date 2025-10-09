<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class InvoiceController extends Controller
{
    /**
     * Display the specified invoice for a company.
     */
    public function show(Company $company, Invoice $invoice)
    {
        if ($invoice->client_id !== $company->id) {
            abort(404);
        }

        return view('admin.companies.invoices.show', [
            'company' => $company,
            'invoice' => $invoice->load(['package']),
        ]);
    }

    /**
     * Download the invoice as PDF file.
     */
    public function download(Company $company, Invoice $invoice)
    {
        if ($invoice->client_id !== $company->id) {
            abort(404);
        }

        // Initialize mPDF with Arabic support
        $mpdf = new Mpdf([
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
            'company' => $company,
            'invoice' => $invoice->load(['package']),
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


