<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('client_packages.invoice') }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #2c3e50;
        }
        
        .header h2 {
            font-size: 18px;
            margin: 5px 0 0 0;
            color: #7f8c8d;
        }
        
        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        
        .invoice-info .left, .invoice-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .invoice-info .right {
            text-align: right;
        }
        
        .info-section h3 {
            font-size: 14px;
            margin: 0 0 10px 0;
            color: #2c3e50;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 5px;
        }
        
        .info-section p {
            margin: 5px 0;
            color: #555;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
         .status-overdue {
             background-color: #f8d7da;
             color: #721c24;
         }
         
         .status-cancelled {
             background-color: #e2e3e5;
             color: #6c757d;
         }
         
         .status-partially-paid {
             background-color: #cff4fc;
             color: #055160;
         }
        
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        
        .invoice-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .invoice-table .text-right {
            text-align: right;
        }
        
        .invoice-table .text-center {
            text-align: center;
        }
        
        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .rtl {
            direction: rtl;
            text-align: right;
        }
        
        .rtl .invoice-info .right {
            text-align: left;
        }
        
        .rtl .invoice-table th,
        .rtl .invoice-table td {
            text-align: right;
        }
        
        .rtl .invoice-table .text-right {
            text-align: left;
        }
    </style>
</head>
<body class="{{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
    <div class="header">
        <h1>{{ __('client_packages.invoice') }}</h1>
        <h2>#{{ $invoice->id }}</h2>
    </div>
    
    <div class="invoice-info">
        <div class="left">
            <div class="info-section">
                <h3>{{ __('common.bill_to') }}</h3>
                <p><strong>{{ __('companies.company_name_en') }}:</strong> {{ $company->company_name_en }}</p>
                <p><strong>{{ __('companies.company_name_ar') }}:</strong> {{ $company->company_name_ar }}</p>
                <p><strong>{{ __('companies.street') }}:</strong> {{ $company->street }}, {{ $company->district }}</p>
                <p><strong>{{ __('companies.city') }}:</strong> {{ $company->city }}, {{ $company->region }}</p>
                @if($company->tax_number)
                    <p><strong>{{ __('companies.tax_number') }}:</strong> {{ $company->tax_number }}</p>
                @endif
            </div>
        </div>
        
        <div class="right">
            <div class="info-section">
                <h3>{{ __('common.invoice_details') }}</h3>
                <p><strong>{{ __('common.invoice_number') }}:</strong> #{{ $invoice->id }}</p>
                <p><strong>{{ __('common.date') }}:</strong> {{ $invoice->issue_date->format('Y-m-d') }}</p>
                <p><strong>{{ __('common.due_date') }}:</strong> {{ $invoice->due_date->format('Y-m-d') }}</p>
                 <p><strong>{{ __('common.status') }}:</strong> 
                     @if($invoice->isPaid())
                         <span class="status-badge status-paid">{{ __('common.paid') }}</span>
                     @elseif($invoice->isOverdue())
                         <span class="status-badge status-overdue">{{ __('common.overdue') }}</span>
                     @elseif($invoice->isCancelled())
                         <span class="status-badge status-cancelled">{{ __('common.cancelled') }}</span>
                     @elseif($invoice->isPartiallyPaid())
                         <span class="status-badge status-partially-paid">{{ __('common.partially_paid') }}</span>
                     @else
                         <span class="status-badge status-pending">{{ __('common.pending') }}</span>
                     @endif
                 </p>
            </div>
        </div>
    </div>
    
    <table class="invoice-table">
        <thead>
            <tr>
                <th>{{ __('client_packages.package') }}</th>
                <th class="text-center">{{ __('common.duration') }}</th>
                <th class="text-right">{{ __('common.price') }}</th>
                <th class="text-right">{{ __('common.total') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $invoice->package?->name }}</strong>
                    @if($invoice->package?->description)
                        <br><small>{{ $invoice->package->description }}</small>
                    @endif
                </td>
                <td class="text-center">{{ $invoice->package?->duration }} {{ __('common.months') }}</td>
                <td class="text-right">{{ number_format($invoice->package?->price ?? $invoice->amount, 2) }} {{ __('common.currency') }}</td>
                <td class="text-right">{{ number_format($invoice->amount, 2) }} {{ __('common.currency') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>{{ __('common.total') }}:</strong></td>
                <td class="text-right"><strong>{{ number_format($invoice->amount, 2) }} {{ __('common.currency') }}</strong></td>
            </tr>
        </tfoot>
    </table>
    
    <div class="footer">
        <p>{{ __('common.invoice_generated_on') }}: {{ now()->format('Y-m-d H:i:s') }}</p>
        <p>{{ __('common.thank_you_for_business') }}</p>
    </div>
</body>
</html>