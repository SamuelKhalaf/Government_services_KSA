@extends('admin.layouts.master')

@section('title', __('payments.add_payment'))

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('payments.add_payment') }}</h1>
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
                    <li class="breadcrumb-item text-muted">{{ __('payments.add_payment') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>{{ __('payments.add_payment_for_invoice') }} #{{ $invoice->id }}</h3>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Invoice Summary -->
                    <div class="row mb-8">
                        <div class="col-md-6">
                            <div class="bg-light-info p-4 rounded">
                                <h5 class="text-info mb-3">{{ __('payments.invoice_summary') }}</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <strong>{{ __('common.total_amount') }}:</strong><br>
                                        <span class="text-primary fs-4 fw-bold">{{ number_format($invoice->amount, 2) }} {{ __('common.currency') }}</span>
                                    </div>
                                    <div class="col-6">
                                        <strong>{{ __('payments.total_paid') }}:</strong><br>
                                        <span class="text-success fs-4 fw-bold">{{ number_format($invoice->total_paid, 2) }} {{ __('common.currency') }}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <strong>{{ __('payments.remaining_balance') }}:</strong><br>
                                        <span class="text-danger fs-4 fw-bold">{{ number_format($invoice->remaining_balance, 2) }} {{ __('common.currency') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light-primary p-4 rounded">
                                <h5 class="text-primary mb-3">{{ __('payments.payment_status') }}</h5>
                                <p><strong>{{ __('common.status') }}:</strong> 
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
                                </p>
                                <p><strong>{{ __('common.due_date') }}:</strong> {{ $invoice->due_date->format('Y-m-d') }}</p>
                                @if($invoice->hasPartialPayments())
                                    <p class="text-warning"><i class="fas fa-exclamation-triangle"></i> {{ __('payments.partial_payment_detected') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form action="{{ route('admin.companies.invoices.payments.store', [$company, $invoice]) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="amount" class="form-label required">{{ __('payments.amount') }}</label>
                                    <input type="number" 
                                           class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" 
                                           name="amount" 
                                           step="0.01" 
                                           min="0.01" 
                                           max="{{ $invoice->remaining_balance }}"
                                           value="{{ old('amount') }}" 
                                           required>
                                    <div class="form-text">{{ __('payments.max_amount') }}: {{ number_format($invoice->remaining_balance, 2) }} {{ __('common.currency') }}</div>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="payment_date" class="form-label required">{{ __('payments.payment_date') }}</label>
                                    <input type="date" 
                                           class="form-control @error('payment_date') is-invalid @enderror" 
                                           id="payment_date" 
                                           name="payment_date" 
                                           value="{{ old('payment_date', now()->format('Y-m-d')) }}" 
                                           max="{{ now()->format('Y-m-d') }}"
                                           required>
                                    @error('payment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="payment_method" class="form-label required">{{ __('payments.payment_method') }}</label>
                                    <select class="form-select @error('payment_method') is-invalid @enderror" 
                                            id="payment_method" 
                                            name="payment_method" 
                                            required>
                                        <option value="">{{ __('payments.select_payment_method') }}</option>
                                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>{{ __('payments.methods.cash') }}</option>
                                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>{{ __('payments.methods.bank_transfer') }}</option>
                                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>{{ __('payments.methods.credit_card') }}</option>
                                        <option value="check" {{ old('payment_method') == 'check' ? 'selected' : '' }}>{{ __('payments.methods.check') }}</option>
                                        <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>{{ __('payments.methods.other') }}</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="reference_number" class="form-label">{{ __('payments.reference_number') }}</label>
                                    <input type="text" 
                                           class="form-control @error('reference_number') is-invalid @enderror" 
                                           id="reference_number" 
                                           name="reference_number" 
                                           value="{{ old('reference_number') }}"
                                           placeholder="{{ __('payments.reference_placeholder') }}">
                                    <div class="form-text">{{ __('payments.reference_help') }}</div>
                                    @error('reference_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="notes" class="form-label">{{ __('payments.notes') }}</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" 
                                      name="notes" 
                                      rows="3" 
                                      placeholder="{{ __('payments.notes_placeholder') }}">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.companies.invoices.show', [$company, $invoice]) }}" class="btn btn-light me-3">
                                {{ __('common.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('payments.record_payment') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
