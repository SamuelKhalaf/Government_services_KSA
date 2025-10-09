@extends('admin.layouts.master')

@section('title', __('client_packages.invoice') . ' #' . $invoice->id)

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('client_packages.invoice') }} #{{ $invoice->id }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">{{ __('common.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.invoices.index') }}" class="text-muted text-hover-primary">{{ __('client_packages.invoices') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('client_packages.invoice') }} #{{ $invoice->id }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('client_packages.invoice') }} #{{ $invoice->id }}</h2>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.invoices.download', $invoice) }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> {{ __('common.download') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-10">
                        <div class="col-md-6">
                            <h4 class="fw-bold mb-3">{{ $invoice->client->company_name_en }}</h4>
                            <div class="text-gray-700">
                                <div>{{ $invoice->client->street }}, {{ $invoice->client->district }}</div>
                                <div>{{ $invoice->client->city }}, {{ $invoice->client->region }}</div>
                                <div>{{ __('companies.tax_number') }}: {{ $invoice->client->tax_number ?? __('N/A') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-5 mt-md-0">
                            <div class="fs-4 fw-bold">{{ __('client_packages.invoice') }} #{{ $invoice->id }}</div>
                            <div class="text-gray-700">{{ __('common.date') }}: {{ $invoice->issue_date->format('Y-m-d') }}</div>
                            <div class="text-gray-700">{{ __('common.due_date') }}: {{ $invoice->due_date->format('Y-m-d') }}</div>
                            <div class="mt-2">
                                @if($invoice->isPaid())
                                    <span class="badge badge-light-success">{{ __('common.paid') }}</span>
                                @elseif($invoice->isOverdue())
                                    <span class="badge badge-light-danger">{{ __('common.overdue') }}</span>
                                @elseif($invoice->isCancelled())
                                    <span class="badge badge-light-secondary">{{ __('common.cancelled') }}</span>
                                @elseif($invoice->isPartiallyPaid())
                                    <span class="badge badge-light-info">{{ __('common.partially_paid') }}</span>
                                @else
                                    <span class="badge badge-light-warning">{{ __('common.pending') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    @if(!$invoice->isCancelled())
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
                    @endif

                    <div class="table-responsive mb-10">
                        <table class="table align-middle table-row-dashed gy-5">
                            <thead>
                                <tr>
                                    <th>{{ __('client_packages.package') }}</th>
                                    <th class="text-end">{{ __('common.price') }}</th>
                                    <th class="text-end">{{ __('common.duration') }}</th>
                                    <th class="text-end">{{ __('common.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $invoice->package?->name }}</div>
                                        <div class="text-muted">{{ $invoice->package?->description }}</div>
                                    </td>
                                    <td class="text-end">{{ number_format($invoice->package?->price ?? $invoice->amount, 2) }} {{ __('common.currency') }}</td>
                                    <td class="text-end">{{ $invoice->package?->duration }} {{ __('common.months') }}</td>
                                    <td class="text-end">{{ number_format($invoice->amount, 2) }} {{ __('common.currency') }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">{{ __('common.total') }}</td>
                                    <td class="text-end fw-bold">{{ number_format($invoice->amount, 2) }} {{ __('common.currency') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('admin.companies.show', $invoice->client) }}" class="btn btn-info me-2">
                                <i class="fas fa-building"></i> {{ __('companies.view_company') }}
                            </a>
                            
                            @if(!$invoice->isCancelled() && !$invoice->isFullyPaid())
                                <a href="{{ route('admin.companies.invoices.payments.create', [$invoice->client, $invoice]) }}" class="btn btn-success me-2">
                                    <i class="fas fa-plus"></i> {{ __('payments.add_payment') }}
                                </a>
                            @endif
                            
                            @if($invoice->payments()->count() > 0)
                                <a href="{{ route('admin.companies.invoices.payments.history', [$invoice->client, $invoice]) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-history"></i> {{ __('payments.payment_history') }}
                                </a>
                            @endif
                        </div>
                        
                        <div>
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-light">
                                <i class="fas fa-arrow-left"></i> {{ __('common.back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
