<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <style>
        .table-responsive .dropdown-menu {
            z-index: 1050 !important;
            position: absolute !important;
        }
        .table-responsive {
            overflow: visible !important;
        }
        .table-responsive .table {
            margin-bottom: 0;
        }
    </style>
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __('client_packages.invoices') }}</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        @php
            $invoices = $company->invoices()->latest('issue_date')->get();
        @endphp

        @if($invoices->count())
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed gy-5">
                    <thead>
                        <tr class="fw-semibold text-gray-600">
                            <th>{{ __('common.id') }}</th>
                            <th>{{ __('client_packages.package') }}</th>
                            <th>{{ __('common.date') }}</th>
                            <th>{{ __('common.due_date') }}</th>
                            <th class="text-end">{{ __('common.amount') }}</th>
                            <th>{{ __('common.status') }}</th>
                            <th class="text-end">{{ __('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-700">
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>#{{ $invoice->id }}</td>
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
                                                <a class="dropdown-item" href="{{ route('admin.companies.invoices.show', [$company, $invoice]) }}">
                                                    <i class="fas fa-eye me-2 text-primary"></i>{{ __('common.view') }}
                                                </a>
                                            </li>
                                            @if(!$invoice->isCancelled() && !$invoice->isFullyPaid())
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.companies.invoices.payments.create', [$company, $invoice]) }}">
                                                        <i class="fas fa-plus me-2 text-success"></i>{{ __('payments.pay') }}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($invoice->payments()->count() > 0)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.companies.invoices.payments.history', [$company, $invoice]) }}">
                                                        <i class="fas fa-history me-2 text-info"></i>{{ __('payments.history') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.companies.invoices.download', [$company, $invoice]) }}">
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
        @else
            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                <div class="d-flex flex-stack flex-grow-1">
                    <div class="fw-semibold">
                        <div class="fs-6 text-gray-700">{{ __('client_packages.messages.no_invoices_found') }}</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->


