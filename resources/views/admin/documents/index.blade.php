@extends('admin.layouts.master')

@section('title', __('documents.documents_list'))

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
                        {{ __('documents.documents_list') }}
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
                        <li class="breadcrumb-item text-muted">@lang('common.client_management')</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ __('documents.documents_list') }}</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-sm fw-bold btn-light">
                        <i class="fas fa-users fs-2"></i>@lang('common.employees')
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

                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="fas fa-search fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-documents-table-filter="search"
                                       class="form-control form-control-solid w-250px ps-13"
                                       placeholder="{{ __('documents.search_documents') }}"
                                       value="{{ request('search') }}" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-documents-table-toolbar="base">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="fas fa-filter fs-2"></i>@lang('common.filter')
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">{{ __('documents.filter_options') }}</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5" data-kt-documents-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('documents.document_type') }}:</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('documents.all_types') }}" data-allow-clear="true" data-kt-documents-table-filter="document_type_id">
                                                <option></option>
                                                @foreach($documentTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('documents.status') }}:</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('documents.all_statuses') }}" data-allow-clear="true" data-kt-documents-table-filter="status">
                                                <option></option>
                                                <option value="active">{{ __('documents.active') }}</option>
                                                <option value="expired">{{ __('documents.expired') }}</option>
                                                <option value="cancelled">{{ __('documents.cancelled') }}</option>
                                                <option value="pending">{{ __('documents.pending') }}</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                <input class="form-check-input" type="checkbox" data-kt-documents-table-filter="expiring_soon" value="1" />
                                                <span class="form-check-label text-gray-600 fw-semibold fs-6">{{ __('documents.expiring_soon') }}</span>
                                            </label>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                <input class="form-check-input" type="checkbox" data-kt-documents-table-filter="expired" value="1" />
                                                <span class="form-check-label text-gray-600 fw-semibold fs-6">{{ __('documents.already_expired') }}</span>
                                            </label>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-documents-table-filter="reset">@lang('common.reset')</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-documents-table-filter="filter">@lang('common.apply')</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_documents_table">
                                <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">@lang('common.employee')</th>
                                    <th class="min-w-125px">@lang('common.company')</th>
                                    <th class="min-w-125px">{{ __('documents.document_type') }}</th>
                                    <th class="min-w-125px">{{ __('documents.document_number') }}</th>
                                    <th class="min-w-100px">{{ __('documents.issue_date') }}</th>
                                    <th class="min-w-100px">{{ __('documents.expiry_date') }}</th>
                                    <th class="min-w-100px">{{ __('documents.status') }}</th>
                                    <th class="text-end min-w-100px">@lang('common.actions')</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                @forelse($documents as $document)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('admin.employees.show', $document->employee) }}" class="text-gray-800 text-hover-primary mb-1">
                                                    {{ $document->employee->full_name_en }}
                                                </a>
                                                <span class="text-muted">{{ $document->employee->full_name_ar }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('admin.companies.show', $document->employee->company) }}" class="text-gray-800 text-hover-primary mb-1">
                                                    {{ $document->employee->company->company_name_en }}
                                                </a>
                                                <span class="text-muted">{{ $document->employee->company->company_name_ar }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($document->documentType->icon)
                                                    <i class="{{ $document->documentType->icon }} fs-3 me-3" style="color: {{ $document->documentType->color ?? '#5E6278' }}"></i>
                                                @endif
                                                <div class="d-flex flex-column">
                                                    <span class="text-gray-800 mb-1">{{ $document->documentType->name_en }}</span>
                                                    <span class="text-muted">{{ $document->documentType->name_ar }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($document->getCustomFieldValue('document_number'))
                                                <span class="badge badge-light-info">{{ $document->getCustomFieldValue('document_number') }}</span>
                                            @else
                                                <span class="text-muted">@lang('common.n_a')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($document->getCustomFieldValue('issue_date'))
                                                {{ \Carbon\Carbon::parse($document->getCustomFieldValue('issue_date'))->format('Y-m-d') }}
                                            @else
                                                <span class="text-muted">@lang('common.n_a')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($document->getCustomFieldValue('expiry_date'))
                                                <div class="d-flex flex-column">
                                                    <span class="text-gray-800 mb-1">{{ \Carbon\Carbon::parse($document->getCustomFieldValue('expiry_date'))->format('Y-m-d') }}</span>
                                                    @if($document->is_expiring_soon)
                                                        <span class="badge badge-light-warning">{{ __('documents.expiring_soon') }}</span>
                                                    @elseif($document->is_expired)
                                                        <span class="badge badge-light-danger">{{ __('documents.expired') }}</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">@lang('common.n_a')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @switch($document->status)
                                                @case('active')
                                                    <span class="badge badge-light-success">{{ __('documents.active') }}</span>
                                                    @break
                                                @case('expired')
                                                    <span class="badge badge-light-danger">{{ __('documents.expired') }}</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge badge-light-secondary">{{ __('documents.cancelled') }}</span>
                                                    @break
                                                @case('pending')
                                                    <span class="badge badge-light-warning">{{ __('documents.pending') }}</span>
                                                    @break
                                                @case('under_process')
                                                    <span class="badge badge-light-info">{{ __('documents.under_process') }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                @lang('common.actions')
                                                <i class="fas fa-chevron-down fs-5 ms-1"></i>
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.employees.documents.show', [$document->employee, $document]) }}" class="menu-link px-3">{{ __('documents.view_document') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @if($document->hasFile())
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.employees.documents.download', [$document->employee, $document]) }}" class="menu-link px-3">{{ __('documents.download_file') }}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                @endif
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.employees.documents.edit', [$document->employee, $document]) }}" class="menu-link px-3">{{ __('documents.edit_document') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-documents-table-filter="delete_row" data-document-id="{{ $document->id }}">{{ __('documents.delete_document') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-search fs-3x text-muted mb-4"></i>
                                                <span class="text-muted fs-6">{{ __('documents.no_documents_found') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->

                        <!--begin::Pagination-->
                        @if($documents->hasPages())
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center py-3">
                                <span class="text-muted">
                                    @lang('common.showing') {{ $documents->firstItem() }} @lang('common.to') {{ $documents->lastItem() }} @lang('common.of') {{ $documents->total() }} @lang('common.results')
                                </span>
                                </div>
                                {{ $documents->links() }}
                            </div>
                        @endif
                        <!--end::Pagination-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
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
        var KTDocumentsList = function () {
            // Define shared variables
            var table = document.getElementById('kt_documents_table');
            var filterForm = document.querySelector('[data-kt-documents-table-filter="form"]');

            // Private functions
            var handleSearchDatatable = function () {
                const filterSearch = document.querySelector('[data-kt-documents-table-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    setTimeout(function() {
                        window.location.href = updateUrlParameter(window.location.href, 'search', e.target.value);
                    }, 500);
                });
            }

            var handleFilterDatatable = function () {
                const filterButton = filterForm.querySelector('[data-kt-documents-table-filter="filter"]');
                const resetButton = filterForm.querySelector('[data-kt-documents-table-filter="reset"]');

                // Filter button event
                filterButton.addEventListener('click', function () {
                    var url = new URL(window.location);

                    // Get all filter values
                    const documentTypeId = filterForm.querySelector('[data-kt-documents-table-filter="document_type_id"]').value;
                    const status = filterForm.querySelector('[data-kt-documents-table-filter="status"]').value;
                    const expiringSoon = filterForm.querySelector('[data-kt-documents-table-filter="expiring_soon"]').checked;
                    const expired = filterForm.querySelector('[data-kt-documents-table-filter="expired"]').checked;

                    // Set URL parameters
                    if (documentTypeId) {
                        url.searchParams.set('document_type_id', documentTypeId);
                    } else {
                        url.searchParams.delete('document_type_id');
                    }

                    if (status) {
                        url.searchParams.set('status', status);
                    } else {
                        url.searchParams.delete('status');
                    }

                    if (expiringSoon) {
                        url.searchParams.set('expiring_soon', '1');
                    } else {
                        url.searchParams.delete('expiring_soon');
                    }

                    if (expired) {
                        url.searchParams.set('expired', '1');
                    } else {
                        url.searchParams.delete('expired');
                    }

                    window.location.href = url.toString();
                });

                // Reset button event
                resetButton.addEventListener('click', function () {
                    var url = new URL(window.location);
                    url.searchParams.delete('document_type_id');
                    url.searchParams.delete('status');
                    url.searchParams.delete('expiring_soon');
                    url.searchParams.delete('expired');
                    window.location.href = url.toString();
                });
            }

            // Helper function to update URL parameters
            function updateUrlParameter(url, param, paramVal) {
                var newAdditionalURL = "";
                var tempArray = url.split("?");
                var baseURL = tempArray[0];
                var additionalURL = tempArray[1];
                var temp = "";
                if (additionalURL) {
                    tempArray = additionalURL.split("&");
                    for (var i = 0; i < tempArray.length; i++) {
                        if (tempArray[i].split('=')[0] != param) {
                            newAdditionalURL += temp + tempArray[i];
                            temp = "&";
                        }
                    }
                }
                if (paramVal) {
                    var rows_txt = temp + "" + param + "=" + paramVal;
                    return baseURL + "?" + newAdditionalURL + rows_txt;
                } else {
                    return baseURL + "?" + newAdditionalURL;
                }
            }

            // Public methods
            return {
                init: function () {
                    if (!table) {
                        return;
                    }

                    handleSearchDatatable();
                    handleFilterDatatable();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDocumentsList.init();
        });
    </script>
@endpush
