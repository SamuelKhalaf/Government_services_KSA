@extends('admin.layouts.master')

@section('title', __('client_packages.invoices'))

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('client_packages.invoices') }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">{{ __('common.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('client_packages.invoices') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            
            <!-- Statistics Cards -->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100px" style="background-color: #F1416C;background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-white me-1 lh-1">{{ $stats['total_invoices'] }}</span>
                                </div>
                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ __('client_packages.invoices') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100px" style="background-color: #7239EA;background-image:url('{{ asset('assets/media/patterns/vector-2.png') }}')">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-white me-1 lh-1">{{ number_format($stats['total_amount'], 2) }}</span>
                                </div>
                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ __('common.total_amount') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100px" style="background-color: #50CD89;background-image:url('{{ asset('assets/media/patterns/vector-3.png') }}')">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-white me-1 lh-1">{{ number_format($stats['paid_amount'], 2) }}</span>
                                </div>
                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ __('payments.total_paid') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100px" style="background-color: #FFC700;background-image:url('{{ asset('assets/media/patterns/vector-4.png') }}')">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-white me-1 lh-1">{{ number_format($stats['remaining_amount'], 2) }}</span>
                                </div>
                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ __('payments.remaining_balance') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100px" style="background-color: #20C997;background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-white me-1 lh-1">{{ $stats['paid_invoices'] }}</span>
                                </div>
                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ __('common.paid') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-2 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100px" style="background-color: #FD7E14;background-image:url('{{ asset('assets/media/patterns/vector-2.png') }}')">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-white me-1 lh-1">{{ $stats['pending_invoices'] + $stats['overdue_invoices'] + $stats['partially_paid_invoices'] }}</span>
                                </div>
                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ __('common.pending') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="card mb-5">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.invoices.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label for="search" class="form-label">{{ __('common.search') }}</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="{{ __('common.search_placeholder') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">{{ __('common.status') }}</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">{{ __('common.all_statuses') }}</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('common.pending') }}</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>{{ __('common.paid') }}</option>
                                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>{{ __('common.overdue') }}</option>
                                <option value="partially_paid" {{ request('status') == 'partially_paid' ? 'selected' : '' }}>{{ __('common.partially_paid') }}</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>{{ __('common.cancelled') }}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="company_id" class="form-label">{{ __('companies.companies') }}</label>
                            <select class="form-select" id="company_id" name="company_id">
                                <option value="">{{ __('common.all_companies') }}</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name_en }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="date_from" class="form-label">{{ __('common.date_from') }}</label>
                            <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="date_to" class="form-label">{{ __('common.date_to') }}</label>
                            <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search"></i> {{ __('common.filter') }}
                            </button>
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-light">
                                <i class="fas fa-times"></i> {{ __('common.clear') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Invoices Table -->
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="fas fa-search position-absolute ms-3"></i>
                            <input type="text" data-kt-invoices-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('common.search_invoices') }}" />
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if($invoices->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_invoices_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">{{ __('common.id') }}</th>
                                        <th class="min-w-125px">{{ __('companies.companies') }}</th>
                                        <th class="min-w-125px">{{ __('client_packages.package') }}</th>
                                        <th class="min-w-125px">{{ __('common.date') }}</th>
                                        <th class="min-w-125px">{{ __('common.due_date') }}</th>
                                        <th class="min-w-125px">{{ __('common.amount') }}</th>
                                        <th class="min-w-125px">{{ __('common.status') }}</th>
                                        <th class="text-end min-w-100px">{{ __('common.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.invoices.show', $invoice) }}" class="text-dark fw-bold text-hover-primary">
                                                    #{{ $invoice->id }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="text-gray-800 fw-bold">{{ $invoice->client->company_name_en }}</span>
                                                    <span class="text-muted fs-7">{{ $invoice->client->company_name_ar }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $invoice->package?->name }}</td>
                                            <td>{{ $invoice->issue_date->format('Y-m-d') }}</td>
                                            <td>{{ $invoice->due_date->format('Y-m-d') }}</td>
                                            <td class="text-end">{{ number_format($invoice->amount, 2) }} {{ __('common.currency') }}</td>
                                            <td>
                                                @if($invoice->isPaid())
                                                    <span class="badge badge-light-success">{{ __('common.paid') }}</span>
                                                @elseif($invoice->isOverdue())
                                                    <span class="badge badge-light-danger">{{ __('common.overdue') }}</span>
                                                @elseif($invoice->isCancelled())
                                                    <span class="badge badge-secondary">{{ __('common.cancelled') }}</span>
                                                @elseif($invoice->isPartiallyPaid())
                                                    <span class="badge badge-light-info">{{ __('common.partially_paid') }}</span>
                                                @else
                                                    <span class="badge badge-light-warning">{{ __('common.pending') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ __('common.actions') }}
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.invoices.show', $invoice) }}">
                                                                <i class="fas fa-eye me-2 text-primary"></i>{{ __('common.view') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.companies.show', $invoice->client) }}">
                                                                <i class="fas fa-building me-2 text-info"></i>{{ __('companies.view_company') }}
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.invoices.download', $invoice) }}">
                                                                <i class="fas fa-download me-2 text-warning"></i>{{ __('common.download') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex flex-stack flex-wrap pt-10">
                            <div class="fs-6 fw-semibold text-gray-700">
                                {{ __('common.showing') }} {{ $invoices->firstItem() }} {{ __('common.to') }} {{ $invoices->lastItem() }} {{ __('common.of') }} {{ $invoices->total() }} {{ __('common.results') }}
                            </div>
                            <ul class="pagination">
                                {{ $invoices->links() }}
                            </ul>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="mb-5">
                                <i class="fas fa-receipt fs-3x text-muted"></i>
                            </div>
                            <h3 class="text-muted">{{ __('client_packages.messages.no_invoices_found') }}</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
