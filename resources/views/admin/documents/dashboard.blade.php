@extends('admin.layouts.master')

@section('title', __('documents.document_dashboard'))

@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ __('documents.document_dashboard') }}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">@lang('common.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('documents.document_dashboard') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.documents.index') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fa fa-file-text"></i>{{ __('documents.all_documents') }}
                </a>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 20-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #F1416C;background-image:url('assets/media/patterns/vector-1.png')">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $stats['total_companies'] }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ __('Total Companies') }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                    <span>{{ $stats['active_companies'] }} @lang('common.active')</span>
                                    <span>{{ number_format(($stats['active_companies'] / max($stats['total_companies'], 1)) * 100, 1) }}%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                    <div class="bg-white rounded h-8px" role="progressbar" style="width: {{ ($stats['active_companies'] / max($stats['total_companies'], 1)) * 100 }}%"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 20-->
                    <!--begin::Card widget 7-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $stats['total_employees'] }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">{{ __('Total Employees') }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column justify-content-end pe-0">
                            <!--begin::Title-->
                            <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">{{ __('Today\'s Active') }}</span>
                            <!--end::Title-->
                            <!--begin::Users group-->
                            <div class="symbol-group symbol-hover flex-nowrap">
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ __('Active Employees') }}">
                                    <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ $stats['active_employees'] }}</span>
                                </div>
                            </div>
                            <!--end::Users group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 7-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Currency-->
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">{{ __('Total') }}</span>
                                    <!--end::Currency-->
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $stats['total_employee_documents'] }}</span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">{{ __('Employee Documents') }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                            <!--begin::Chart-->
                            <div class="d-flex flex-center me-5 pt-2">
                                <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" 
                                     data-kt-size="70" 
                                     data-kt-line="11"
                                     data-kt-active="{{ $stats['active_employee_documents'] }}"
                                     data-kt-expired="{{ $stats['expired_employee_documents'] }}"
                                     data-kt-expiring="{{ $stats['expiring_employee_documents'] }}"></div>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                <!--begin::Label-->
                                <div class="d-flex fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">@lang('common.active')</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">{{ $stats['active_employee_documents'] }}</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fw-semibold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">{{ __('Expiring Soon') }}</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">{{ $stats['expiring_employee_documents'] }}</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-3px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">{{ __('Expired') }}</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">{{ $stats['expired_employee_documents'] }}</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                    <!--begin::List Widget 26-->
                    <div class="card card-flush h-lg-50">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title text-gray-800 fw-bold">{{ __('Company Documents') }}</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Flag-->
                                <span class="badge badge-light-success fs-base">
                                    <i class="fa fa-shield-alt text-success me-2"></i>{{ __('Civil Defense') }}
                                </span>
                                <!--end::Flag-->
                                <!--begin::Number-->
                                <span class="fs-6 text-gray-700 fw-bold">{{ $stats['civil_defense_licenses'] }}</span>
                                <!--end::Number-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Flag-->
                                <span class="badge badge-light-primary fs-base">
                                    <i class="fa fa-building text-primary me-2"></i>{{ __('Municipality') }}
                                </span>
                                <!--end::Flag-->
                                <!--begin::Number-->
                                <span class="fs-6 text-gray-700 fw-bold">{{ $stats['municipality_licenses'] }}</span>
                                <!--end::Number-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Flag-->
                                <span class="badge badge-light-warning fs-base">
                                    <i class="fa fa-file-text text-warning me-2"></i>{{ __('Branch Registration') }}
                                </span>
                                <!--end::Flag-->
                                <!--begin::Number-->
                                <span class="fs-6 text-gray-700 fw-bold">{{ $stats['branch_registrations'] }}</span>
                                <!--end::Number-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List Widget 26-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6">
                    <!--begin::Chart widget 28-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">{{ __('Document Trends') }}</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ __('Documents added over time') }}</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Chart container-->
                            <div id="kt_charts_widget_28" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
                            <!--end::Chart container-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 28-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Table widget 14-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">{{ __('Expiring Documents') }}</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ __('Documents expiring in the next 30 days') }}</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Actions-->
                            <div class="card-toolbar">
                                <a href="{{ route('admin.expiring-documents') }}" class="btn btn-sm btn-light">{{ __('View All') }}</a>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_14_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-100px">{{ __('Document') }}</th>
                                            <th class="text-end min-w-100px">{{ __('Type') }}</th>
                                            <th class="text-end min-w-125px">{{ __('Company/Employee') }}</th>
                                            <th class="text-end min-w-100px">{{ __('Expiry Date') }}</th>
                                            <th class="text-end min-w-50px">@lang('common.status')</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        @forelse($expiringDocuments['employee_documents'] as $document)
                                            <tr>
                                                <!--begin::Order-->
                                                <td>
                                                    <a href="{{ route('admin.employees.documents.show', [$document->employee, $document]) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $document->document_number }}</a>
                                                </td>
                                                <!--end::Order-->
                                                <!--begin::Type-->
                                                <td class="text-end">
                                                    <span class="badge badge-light-info">{{ $document->documentType->name_en ?? 'Unknown' }}</span>
                                                </td>
                                                <!--end::Type-->
                                                <!--begin::Company-->
                                                <td class="text-end">
                                                    <a href="{{ route('admin.employees.show', $document->employee) }}" class="text-gray-600 text-hover-primary">{{ $document->employee->full_name_en }}</a>
                                                    <div class="text-muted fs-7">{{ $document->employee->company->company_name_en }}</div>
                                                </td>
                                                <!--end::Company-->
                                                <!--begin::Date-->
                                                <td class="text-end">
                                                    <span class="text-gray-800 fw-bold">{{ $document->expiry_date->format('M d, Y') }}</span>
                                                    <div class="text-muted fs-7">
                                                        @php
                                                            $daysToExpiry = now()->diffInDays($document->expiry_date, false);
                                                        @endphp
                                                        @if($daysToExpiry <= 7)
                                                            <span class="text-danger">{{ $daysToExpiry }} {{ __('days left') }}</span>
                                                        @elseif($daysToExpiry <= 14)
                                                            <span class="text-warning">{{ $daysToExpiry }} {{ __('days left') }}</span>
                                                        @else
                                                            <span class="text-muted">{{ $daysToExpiry }} {{ __('days left') }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <!--end::Date-->
                                                <!--begin::Status-->
                                                <td class="text-end">
                                                    {!! $document->statusBadge !!}
                                                </td>
                                                <!--end::Status-->
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-10">
                                                    {{ __('No expiring employee documents found') }}
                                                </td>
                                            </tr>
                                        @endforelse

                                        @foreach($expiringDocuments['civil_defense_documents'] as $document)
                                            <tr>
                                                <!--begin::Order-->
                                                <td>
                                                    <a href="{{ route('admin.companies.civil-defense-licenses.show', [$document->company, $document]) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $document->license_number }}</a>
                                                </td>
                                                <!--end::Order-->
                                                <!--begin::Type-->
                                                <td class="text-end">
                                                    <span class="badge badge-light-success">{{ __('Civil Defense') }}</span>
                                                </td>
                                                <!--end::Type-->
                                                <!--begin::Company-->
                                                <td class="text-end">
                                                    <a href="{{ route('admin.companies.show', $document->company) }}" class="text-gray-600 text-hover-primary">{{ $document->company->company_name_en }}</a>
                                                </td>
                                                <!--end::Company-->
                                                <!--begin::Date-->
                                                <td class="text-end">
                                                    <span class="text-gray-800 fw-bold">{{ $document->expiry_date->format('M d, Y') }}</span>
                                                    <div class="text-muted fs-7">
                                                        @php
                                                            $daysToExpiry = now()->diffInDays($document->expiry_date, false);
                                                        @endphp
                                                        @if($daysToExpiry <= 7)
                                                            <span class="text-danger">{{ $daysToExpiry }} {{ __('days left') }}</span>
                                                        @elseif($daysToExpiry <= 14)
                                                            <span class="text-warning">{{ $daysToExpiry }} {{ __('days left') }}</span>
                                                        @else
                                                            <span class="text-muted">{{ $daysToExpiry }} {{ __('days left') }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <!--end::Date-->
                                                <!--begin::Status-->
                                                <td class="text-end">
                                                    <span class="badge badge-light-success">@lang('common.active')</span>
                                                </td>
                                                <!--end::Status-->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Table widget 14-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::List widget 25-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">{{ __('Recent Activities') }}</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ __('Latest document activities') }}</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Timeline-->
                            <div class="timeline-label">
                                @forelse($recentActivities as $activity)
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">{{ $activity['date']->format('H:i') }}</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-circle fs-2 text-gray-400"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Text-->
                                        <div class="fw-mormal timeline-content text-muted ps-3">
                                            <div class="fw-bold text-gray-800">{{ $activity['title'] }}</div>
                                            <div class="text-gray-600">{{ $activity['description'] }}</div>
                                            <div class="text-muted fs-7">{{ $activity['company'] }}</div>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                @empty
                                    <div class="text-center text-muted py-10">
                                        {{ __('No recent activities found') }}
                                    </div>
                                @endforelse
                            </div>
                            <!--end::Timeline-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 25-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection

@push('scripts')
<script>
"use strict";

// Class definition
var KTDocumentDashboard = function () {
    // Private functions
    var initChart = function () {
        var element = document.getElementById('kt_charts_widget_28');
        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
        var baseColor = KTUtil.getCssVariableValue('--kt-primary');
        var secondaryColor = KTUtil.getCssVariableValue('--kt-info');

        if (!element) {
            return;
        }

        var chartData = @json($chartData);

        var options = {
            series: [{
                name: '{{ __("Employee Documents") }}',
                data: chartData.employee_documents
            }, {
                name: '{{ __("Company Documents") }}',
                data: chartData.company_documents
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseColor, secondaryColor]
            },
            xaxis: {
                categories: chartData.months,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return val + " {{ __('documents') }}"
                    }
                }
            },
            colors: [baseColor, secondaryColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: baseColor,
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    var initPieChart = function () {
        var element = document.getElementById('kt_card_widget_17_chart');
        
        if (!element) {
            return;
        }

        var active = parseInt(element.getAttribute('data-kt-active'));
        var expired = parseInt(element.getAttribute('data-kt-expired'));
        var expiring = parseInt(element.getAttribute('data-kt-expiring'));

        var options = {
            series: [active, expiring, expired],
            chart: {
                type: 'donut',
                width: 70,
                height: 70
            },
            colors: [
                KTUtil.getCssVariableValue('--kt-success'),
                KTUtil.getCssVariableValue('--kt-primary'), 
                KTUtil.getCssVariableValue('--kt-danger')
            ],
            stroke: {
                width: 0
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%'
                    }
                }
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    // Public methods
    return {
        init: function () {
            initChart();
            initPieChart();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDocumentDashboard.init();
});
</script>
@endpush
