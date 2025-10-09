<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoicePaymentController extends Controller
{
    /**
     * Show the payment form for an invoice.
     */
    public function create(Company $company, Invoice $invoice)
    {
        if ($invoice->client_id !== $company->id) {
            abort(404);
        }

        if ($invoice->isCancelled()) {
            return redirect()->back()->with('error', __('payments.messages.cannot_pay_cancelled_invoice'));
        }

        if ($invoice->isFullyPaid()) {
            return redirect()->back()->with('info', __('payments.messages.invoice_already_paid'));
        }

        return view('admin.companies.invoices.payments.create', compact('company', 'invoice'));
    }

    /**
     * Store a new payment for an invoice.
     */
    public function store(Request $request, Company $company, Invoice $invoice)
    {
        if ($invoice->client_id !== $company->id) {
            abort(404);
        }

        if ($invoice->isCancelled()) {
            return redirect()->back()->with('error', __('payments.messages.cannot_pay_cancelled_invoice'));
        }

        if ($invoice->isFullyPaid()) {
            return redirect()->back()->with('info', __('payments.messages.invoice_already_paid'));
        }

        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . $invoice->remaining_balance,
            'payment_date' => 'required|date|before_or_equal:today',
            'payment_method' => 'required|in:cash,bank_transfer,credit_card,check,other',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ], [
            'amount.max' => __('payments.validation.amount_exceeds_balance'),
        ]);

        DB::beginTransaction();

        try {
            // Create the payment
            $payment = InvoicePayment::create([
                'invoice_id' => $invoice->id,
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'reference_number' => $request->reference_number,
                'notes' => $request->notes,
                'created_by' => Auth::id(),
            ]);

            // Update invoice payment status
            $invoice->updatePaymentStatus();

            DB::commit();

            $message = $invoice->isFullyPaid() 
                ? __('payments.messages.payment_completed_invoice_paid')
                : __('payments.messages.payment_recorded');

            return redirect()->route('admin.companies.invoices.show', [$company, $invoice])
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', __('payments.messages.payment_failed'));
        }
    }

    /**
     * Show payment history for an invoice.
     */
    public function history(Company $company, Invoice $invoice)
    {
        if ($invoice->client_id !== $company->id) {
            abort(404);
        }

        $payments = $invoice->payments()->with('createdBy')->orderBy('payment_date', 'desc')->get();

        return view('admin.companies.invoices.payments.history', compact('company', 'invoice', 'payments'));
    }

    /**
     * Delete a payment (admin only).
     */
    public function destroy(Company $company, Invoice $invoice, InvoicePayment $payment)
    {
        if ($invoice->client_id !== $company->id || $payment->invoice_id !== $invoice->id) {
            abort(404);
        }

        DB::beginTransaction();

        try {
            $payment->delete();

            // Update invoice payment status
            $invoice->updatePaymentStatus();

            DB::commit();

            return redirect()->route('admin.companies.invoices.payments.history', [$company, $invoice])
                ->with('success', __('payments.messages.payment_deleted'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', __('payments.messages.payment_delete_failed'));
        }
    }
}