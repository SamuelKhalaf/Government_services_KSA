@extends('admin.layouts.master')

@section('title', __('companies.additional_documents') . ' - ' . $company->company_name_en)

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
                    {{ __('companies.additional_documents') }}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">{{ __('common.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.index') }}" class="text-muted text-hover-primary">{{ __('common.companies') }}</a>
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
                    <li class="breadcrumb-item text-muted">{{ __('companies.additional_documents') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_COMPANY_DOCUMENTS->value))
                <a href="{{ route('admin.companies.documents.create', $company) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fa-solid fa-plus fs-2"></i>{{ __('companies.add_document') }}
                </a>
                @endif
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
                        <h2>{{ __('companies.additional_documents') }} - {{ $company->company_name_en }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_company_documents_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">{{ __('common.document_type') }}</th>
                                    <th class="min-w-125px">{{ __('common.document_number') }}</th>
                                    <th class="min-w-125px">{{ __('common.issue_date') }}</th>
                                    <th class="min-w-125px">{{ __('common.expiry_date') }}</th>
                                    <th class="min-w-100px">{{ __('common.status') }}</th>
                                    <th class="min-w-100px">{{ __('common.files') }}</th>
                                    <th class="text-end min-w-100px">{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse($documents as $document)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-dark fw-bold">{{ app()->getLocale() === 'ar' ? $document->documentType->name_ar : $document->documentType->name_en }}</span>
                                                <span class="text-muted">{{ $document->documentType->code }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark">{{ $document->getCustomFieldValue('document_number') ?? __('common.n_a') }}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark">{{ $document->getCustomFieldValue('issue_date') ? \Carbon\Carbon::parse($document->getCustomFieldValue('issue_date'))->format('Y-m-d') : __('common.n_a') }}</span>
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
                                                    <span class="badge badge-light-success">{{ __('common.active') }}</span>
                                                    @break
                                                @case('expired')
                                                    <span class="badge badge-light-danger">{{ __('common.expired') }}</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge badge-light-secondary">{{ __('common.cancelled') }}</span>
                                                    @break
                                                @case('pending')
                                                    <span class="badge badge-light-warning">{{ __('common.pending') }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($document->hasFile())
                                                <span class="badge badge-light-success">
                                                    <i class="fa-solid fa-file me-1"></i>{{ __('common.uploaded') }}
                                                </span>
                                            @else
                                                <span class="badge badge-light-secondary">{{ __('common.no_file') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                {{ __('common.actions') }}
                                                <i class="fa-solid fa-down fs-5 ms-1"></i>
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.companies.documents.show', [$company, $document]) }}" class="menu-link px-3">{{ __('common.view') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @if(auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_COMPANY_DOCUMENTS->value))
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.companies.documents.edit', [$company, $document]) }}" class="menu-link px-3">{{ __('common.edit') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @endif
                                                @if($document->hasFile())
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.companies.documents.download', [$company, $document]) }}" class="menu-link px-3">{{ __('common.download') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @endif
                                                @if(auth()->user()->can(\App\Enums\PermissionEnum::DELETE_COMPANY_DOCUMENTS->value))
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-danger" data-kt-company-documents-table-filter="delete_row" data-document-id="{{ $document->id }}">{{ __('common.delete') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @endif
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fa-solid fa-file-circle-plus fs-3x text-muted mb-4"></i>
                                                <span class="text-muted fs-6">{{ __('companies.no_additional_documents') }}</span>
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
                                    {{ __('companies.showing') }} {{ $documents->firstItem() }} {{ __('companies.to') }} {{ $documents->lastItem() }} {{ __('companies.of') }} {{ $documents->total() }} {{ __('companies.results') }}
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

<!--begin::Modals-->
<!--begin::Modal - Delete Document-->
<div class="modal fade" id="kt_modal_delete_document" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">{{ __('companies.delete_document') }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-company-documents-modal-action="close">
                    <i class="fa-solid fa-xmark fs-1"></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_delete_document_form" class="form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="fv-row mb-7">
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                            <i class="fa-solid fa-triangle-exclamation fs-2tx text-warning me-4"></i>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">{{ __('companies.are_you_sure') }}</h4>
                                    <div class="fs-6 text-gray-700">{{ __('companies.delete_document_warning') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-company-documents-modal-action="cancel">{{ __('common.cancel') }}</button>
                        <button type="submit" class="btn btn-danger" data-kt-company-documents-modal-action="submit">
                            <span class="indicator-label">{{ __('common.delete') }}</span>
                            <span class="indicator-progress">{{ __('companies.please_wait') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Delete Document-->
<!--end::Modals-->
@endsection

@push('scripts')
<script>
"use strict";

// Class definition
var KTCompanyDocumentsList = function () {
    // Define shared variables
    var table = document.getElementById('kt_company_documents_table');
    var deleteModal = document.getElementById('kt_modal_delete_document');
    var deleteForm = document.getElementById('kt_modal_delete_document_form');

    // Private functions
    var initDeleteModal = function () {
        if (!deleteModal) return;

        $(deleteModal).on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            var documentId = $(button).data('document-id');
            var form = $(this).find('form');
            form.attr('action', '{{ route("admin.companies.documents.destroy", [":company", ":document"]) }}'.replace(':company', {{ $company->id }}).replace(':document', documentId));
        });
    }

    var handleDeleteActions = function () {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-company-documents-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Show modal
                $('#kt_modal_delete_document').modal('show');

                // Set document ID for deletion
                const documentId = e.target.dataset.documentId;
                deleteForm.action = deleteForm.action.replace(':document', documentId);
            })
        });
    }

    // Public methods
    return {
        init: function () {
            if (!table) {
                return;
            }

            initDeleteModal();
            handleDeleteActions();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTCompanyDocumentsList.init();
});
</script>
@endpush
