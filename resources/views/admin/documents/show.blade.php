@extends('admin.layouts.master')

@section('title', $document->documentType->name_en ?? $document->document_type_id . ' - ' . $document->document_number)

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
                        {{ $document->documentType->name_en ?? $document->document_type_id }}
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.companies.show', $employee->company) }}" class="text-muted text-hover-primary">{{ $employee->company->company_name_en }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.employees.show', $employee) }}" class="text-muted text-hover-primary">{{ $employee->full_name_en }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ $document->document_number }}</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @if($document->file_path)
                        <a href="{{ route('admin.employees.documents.download', [$employee, $document]) }}" class="btn btn-sm fw-bold btn-success" target="_blank">
                            <i class="ki-duotone ki-file-down fs-2"></i>@lang('documents.download_file')
                        </a>
                    @endif
                    <a href="{{ route('admin.employees.documents.edit', [$employee, $document]) }}" class="btn btn-sm fw-bold btn-primary">
                        <i class="ki-duotone ki-pencil fs-2"></i>@lang('documents.edit_document')
                    </a>
                    <button type="button" class="btn btn-sm fw-bold btn-danger" data-bs-toggle="modal" data-bs-target="#delete_document_modal">
                        <i class="ki-duotone ki-trash fs-2"></i>@lang('documents.delete_document')
                    </button>
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

                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body pt-15">
                                <!--begin::Summary-->
                                <div class="d-flex flex-center flex-column mb-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <div class="symbol-label fs-3 bg-light-info text-info">
                                            <i class="ki-duotone ki-document fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">{{ $document->document_number }}</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fs-5 fw-semibold text-muted mb-6">{{ $document->documentType->name_en ?? $document->document_type_id }}</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap flex-center">
                                        <!--begin::Stats-->
                                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                            <div class="fs-4 fw-bold text-gray-700">
                                                {!! $document->statusBadge !!}
                                            </div>
                                            <div class="fw-semibold text-muted">@lang('common.status')</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_document_view_details" role="button" aria-expanded="false" aria-controls="kt_document_view_details">@lang('documents.document_details')
                                        <span class="ms-2 rotate-180">
                                        <i class="ki-duotone ki-down fs-3"></i>
                                    </span>
                                    </div>
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--begin::Details content-->
                                <div id="kt_document_view_details" class="collapse show">
                                    <div class="py-5 fs-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">@lang('documents.employee')</div>
                                        <div class="text-gray-600">
                                            <a href="{{ route('admin.employees.show', $employee) }}" class="text-gray-600 text-hover-primary">{{ $employee->full_name_en }}</a>
                                        </div>
                                        <!--end::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">@lang('documents.company')</div>
                                        <div class="text-gray-600">
                                            <a href="{{ route('admin.companies.show', $employee->company) }}" class="text-gray-600 text-hover-primary">{{ $employee->company->company_name_en }}</a>
                                        </div>
                                        <!--end::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">@lang('documents.document_type')</div>
                                        <div class="text-gray-600">
                                            {{ $document->documentType->name_en ?? $document->document_type_id }}
                                            @if($document->documentType && $document->documentType->name_ar)
                                                <br><span class="text-muted">{{ $document->documentType->name_ar }}</span>
                                            @endif
                                        </div>
                                        <!--end::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">@lang('documents.issue_date')</div>
                                        <div class="text-gray-600">{{ $document->issue_date?->format('Y-m-d') ?? __('common.n_a') }}</div>
                                        <!--end::Details item-->
                                        @if($document->expiry_date)
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">@lang('documents.expiry_date')</div>
                                            <div class="text-gray-600">
                                                {{ $document->expiry_date->format('Y-m-d') }}
                                                @if($document->isExpiringSoon)
                                                    <br><span class="badge badge-light-warning mt-1">@lang('documents.expiring_soon')</span>
                                                @elseif($document->isExpired)
                                                    <br><span class="badge badge-light-danger mt-1">@lang('documents.already_expired')</span>
                                                @else
                                                    <br><span class="badge badge-light-success mt-1">@lang('documents.valid')</span>
                                                @endif
                                            </div>
                                            <!--end::Details item-->
                                        @endif
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">@lang('documents.issuing_authority')</div>
                                        <div class="text-gray-600">{{ $document->issuing_authority ?? __('common.n_a') }}</div>
                                        <!--end::Details item-->
                                        @if($document->fees_amount)
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">@lang('documents.fees')</div>
                                            <div class="text-gray-600">{{ number_format($document->fees_amount, 2) }} SAR</div>
                                            <!--end::Details item-->
                                        @endif
                                    </div>
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->

                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_document_view_overview_tab">@lang('common.overview')</a>
                            </li>
                            <!--end:::Tab item-->
                            @if($document->file_path)
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_document_view_file_tab">@lang('documents.document_file')</a>
                                </li>
                                <!--end:::Tab item-->
                            @endif
                            @if($document->dynamic_fields && count($document->dynamic_fields) > 0)
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_document_view_additional_tab">@lang('documents.additional_info')</a>
                                </li>
                                <!--end:::Tab item-->
                            @endif
                        </ul>
                        <!--end:::Tabs-->

                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_document_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>@lang('documents.document_information')</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                <tr>
                                                    <td class="text-muted">@lang('documents.document_number')</td>
                                                    <td class="fw-bold text-end">{{ $document->document_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">@lang('documents.document_type')</td>
                                                    <td class="fw-bold text-end">{{ $document->documentType->name_en ?? $document->document_type_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">@lang('common.status')</td>
                                                    <td class="fw-bold text-end">{!! $document->statusBadge !!}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">@lang('documents.issue_date')</td>
                                                    <td class="fw-bold text-end">{{ $document->issue_date?->format('Y-m-d') ?? __('common.n_a') }}</td>
                                                </tr>
                                                @if($document->expiry_date)
                                                    <tr>
                                                        <td class="text-muted">@lang('documents.expiry_date')</td>
                                                        <td class="fw-bold text-end">
                                                            {{ $document->expiry_date->format('Y-m-d') }}
                                                            @if($document->isExpiringSoon)
                                                                <span class="badge badge-light-warning ms-2">@lang('documents.expiring_soon')</span>
                                                            @elseif($document->isExpired)
                                                                <span class="badge badge-light-danger ms-2">@lang('documents.already_expired')</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-muted">@lang('documents.issuing_authority')</td>
                                                    <td class="fw-bold text-end">{{ $document->issuing_authority ?? __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">@lang('documents.place_of_issue')</td>
                                                    <td class="fw-bold text-end">{{ $document->issue_place ?? __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">@lang('documents.reference_number')</td>
                                                    <td class="fw-bold text-end">{{ $document->reference_number ?? __('common.n_a') }}</td>
                                                </tr>
                                                @if($document->fees_amount)
                                                    <tr>
                                                        <td class="text-muted">@lang('documents.fees_amount')</td>
                                                        <td class="fw-bold text-end">{{ number_format($document->fees_amount, 2) }} SAR</td>
                                                    </tr>
                                                @endif
                                                @if($document->enable_reminder && $document->reminder_days)
                                                    <tr>
                                                        <td class="text-muted">@lang('documents.reminder_settings')</td>
                                                        <td class="fw-bold text-end">
                                                            <span class="badge badge-light-info">@lang('common.enabled')</span>
                                                            <br><small class="text-muted">{{ $document->reminder_days }} @lang('documents.days_before_expiry')</small>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-muted">@lang('common.created_at')</td>
                                                    <td class="fw-bold text-end">{{ $document->created_at->format('Y-m-d H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">@lang('common.last_updated')</td>
                                                    <td class="fw-bold text-end">{{ $document->updated_at->format('Y-m-d H:i') }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->

                                        @if($document->notes)
                                            <!--begin::Notes section-->
                                            <div class="mt-10">
                                                <h4 class="text-gray-800 mb-5">@lang('documents.notes')</h4>
                                                <div class="bg-light-info rounded p-5">
                                                    <div class="text-gray-700">{!! nl2br(e($document->notes)) !!}</div>
                                                </div>
                                            </div>
                                            <!--end::Notes section-->
                                        @endif
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->

                            @if($document->file_path)
                                <!--begin:::Tab pane-->
                                <div class="tab-pane fade" id="kt_document_view_file_tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>@lang('documents.document_file')</h2>
                                            </div>
                                            <!--end::Card title-->
                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar">
                                                <a href="{{ route('admin.employees.documents.download', [$employee, $document]) }}" class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="ki-duotone ki-file-down fs-2"></i>@lang('documents.download_file')
                                                </a>
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <div class="text-center">
                                                @php
                                                    $fileExtension = strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                                                @endphp

                                                @if($fileExtension === 'pdf')
                                                    <div class="mb-5">
                                                        <i class="ki-duotone ki-file-text fs-5x text-danger mb-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <div class="fw-bold text-gray-700 fs-4">@lang('documents.pdf_document')</div>
                                                        <div class="text-muted">@lang('documents.click_download_to_view')</div>
                                                    </div>
                                                @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                                    <div class="mb-5">
                                                        <img src="{{ asset('storage/' . $document->file_path) }}"
                                                             alt="{{ $document->document_number }}"
                                                             class="img-fluid rounded shadow-sm"
                                                             style="max-height: 500px;" />
                                                    </div>
                                                @else
                                                    <div class="mb-5">
                                                        <i class="ki-duotone ki-file fs-5x text-primary mb-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <div class="fw-bold text-gray-700 fs-4">@lang('documents.document_file')</div>
                                                        <div class="text-muted">@lang('documents.click_download_to_view')</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end:::Tab pane-->
                            @endif

                            @if($document->dynamic_fields && count($document->dynamic_fields) > 0)
                                <!--begin:::Tab pane-->
                                <div class="tab-pane fade" id="kt_document_view_additional_tab" role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>@lang('documents.additional_information')</h2>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0 pb-5">
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed gy-5">
                                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                                    @foreach($document->dynamic_fields as $key => $value)
                                                        <tr>
                                                            <td class="text-muted">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                                            <td class="fw-bold text-end">{{ $value ?? __('common.n_a') }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end:::Tab pane-->
                            @endif
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    <!--begin::Delete Modal-->
    <div class="modal fade" id="delete_document_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_delete_document_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">@lang('documents.delete_document')</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_delete_document_form" class="form" action="{{ route('admin.employees.documents.destroy', [$employee, $document]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!--begin::Heading-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">@lang('documents.confirm_delete_document')</label>
                            <!--end::Label-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">
                                @lang('documents.document'): <strong>{{ $document->document_number }}</strong><br>
                                @lang('documents.type'): <strong>{{ $document->documentType->name_en ?? $document->document_type_id }}</strong><br>
                                @lang('documents.delete_warning')
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">@lang('common.cancel')</button>
                            <button type="submit" class="btn btn-danger">
                                <span class="indicator-label">@lang('documents.delete_document')</span>
                                <span class="indicator-progress">@lang('common.please_wait')
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Delete Modal-->
@endsection
