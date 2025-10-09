@extends('admin.layouts.master')

@section('title', __('payments.payment_history'))

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('payments.payment_history') }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.index') }}" class="text-muted text-hover-primary">{{ __('companies.companies') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.show', $company) }}" class="text-muted text-hover-primary">{{ $company->company_name_en }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.invoices.show', [$company, $invoice]) }}" class="text-muted text-hover-primary">{{ __('client_packages.invoice') }} #{{ $invoice->id }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('payments.payment_history') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ __('payments.payment_history_for_invoice') }} #{{ $invoice->id }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.companies.invoices.show', [$company, $invoice]) }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> {{ __('common.back_to_invoice') }}
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Invoice Summary -->
                    <div class="row mb-8">
                        <div class="col-md-4">
                            <div class="bg-light-info p-4 rounded text-center">
                                <h5 class="text-info mb-2">{{ __('common.total_amount') }}</h5>
                                <span class="text-primary fs-2 fw-bold">{{ number_format($invoice->amount, 2) }} {{ __('common.currency') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light-success p-4 rounded text-center">
                                <h5 class="text-success mb-2">{{ __('payments.total_paid') }}</h5>
                                <span class="text-success fs-2 fw-bold">{{ number_format($invoice->total_paid, 2) }} {{ __('common.currency') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light-danger p-4 rounded text-center">
                                <h5 class="text-danger mb-2">{{ __('payments.remaining_balance') }}</h5>
                                <span class="text-danger fs-2 fw-bold">{{ number_format($invoice->remaining_balance, 2) }} {{ __('common.currency') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($payments->count() > 0)
                        <!-- Payments Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-row-bordered gy-5 gs-7">
                                <thead>
                                    <tr class="fw-semibold fs-6 text-gray-800">
                                        <th>{{ __('payments.payment_date') }}</th>
                                        <th>{{ __('payments.amount') }}</th>
                                        <th>{{ __('payments.payment_method') }}</th>
                                        <th>{{ __('payments.reference_number') }}</th>
                                        <th>{{ __('payments.notes') }}</th>
                                        <th>{{ __('common.created_by') }}</th>
                                        <th>{{ __('common.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">{{ $payment->payment_date->format('Y-m-d') }}</span>
                                                <br>
                                                <small class="text-muted">{{ $payment->created_at->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">{{ number_format($payment->amount, 2) }} {{ __('common.currency') }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-primary">{{ $payment->payment_method_label }}</span>
                                            </td>
                                            <td>
                                                @if($payment->reference_number)
                                                    <span class="fw-bold">{{ $payment->reference_number }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->notes)
                                                    <span class="text-muted">{{ Str::limit($payment->notes, 50) }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-bold">{{ $payment->createdBy->name }}</span>
                                                <br>
                                                <small class="text-muted">{{ $payment->created_at->format('Y-m-d H:i') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <button type="button" 
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#paymentModal{{ $payment->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    
                                                    @can('delete_invoice_payments')
                                                    <form action="{{ route('admin.companies.invoices.payments.destroy', [$company, $invoice, $payment]) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('{{ __('payments.confirm_delete_payment') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Payment Details Modal -->
                                        <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="fw-bold">{{ __('payments.payment_details') }}</h2>
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <strong>{{ __('payments.amount') }}:</strong><br>
                                                                <span class="text-success fs-4 fw-bold">{{ number_format($payment->amount, 2) }} {{ __('common.currency') }}</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>{{ __('payments.payment_date') }}:</strong><br>
                                                                <span class="fw-bold">{{ $payment->payment_date->format('Y-m-d') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <strong>{{ __('payments.payment_method') }}:</strong><br>
                                                                <span class="badge badge-light-primary fs-6">{{ $payment->payment_method_label }}</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>{{ __('payments.reference_number') }}:</strong><br>
                                                                <span class="fw-bold">{{ $payment->reference_number ?: '-' }}</span>
                                                            </div>
                                                        </div>
                                                        @if($payment->notes)
                                                        <div class="mb-5">
                                                            <strong>{{ __('payments.notes') }}:</strong><br>
                                                            <p class="text-muted">{{ $payment->notes }}</p>
                                                        </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>{{ __('common.created_by') }}:</strong><br>
                                                                <span class="fw-bold">{{ $payment->createdBy->name }}</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>{{ __('common.created_at') }}:</strong><br>
                                                                <span class="text-muted">{{ $payment->created_at->format('Y-m-d H:i:s') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="mb-5">
                                <i class="fas fa-receipt fs-3x text-muted"></i>
                            </div>
                            <h3 class="text-muted">{{ __('payments.no_payments_found') }}</h3>
                            <p class="text-muted">{{ __('payments.no_payments_description') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
