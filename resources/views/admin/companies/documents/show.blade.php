@extends('admin.layouts.master')

@section('title', __('companies.document_details') . ' - ' . ($document->getCustomFieldValue('document_number') ?? __('common.n_a')))

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
                    {{ __('companies.document_details') }}
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
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.documents.index', $company) }}" class="text-muted text-hover-primary">{{ __('companies.additional_documents') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ $document->getCustomFieldValue('document_number') ?? __('common.n_a') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if($document->hasFile())
                <a href="{{ route('admin.companies.documents.download', [$company, $document]) }}" class="btn btn-sm fw-bold btn-light">
                    <i class="fa-solid fa-download fs-2"></i>{{ __('common.download') }}
                </a>
                @endif
                <a href="{{ route('admin.companies.documents.edit', [$company, $document]) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fa-solid fa-pencil fs-2"></i>{{ __('common.edit') }}
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
                                    <div class="symbol-label fs-3 bg-light-primary text-primary">
                                        <i class="fa-solid fa-file"></i>
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                    {{ app()->getLocale() === 'ar' ? $document->documentType->name_ar : $document->documentType->name_en }}
                                </a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="fs-5 fw-semibold text-muted mb-6">{{ $document->documentType->code }}</div>
                                <!--end::Position-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap flex-center">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-75px">{{ $document->getCustomFieldValue('document_number') ?? __('common.n_a') }}</span>
                                            <i class="fa-solid fa-file-text fs-3 text-primary">
                                            </i>
                                        </div>
                                        <div class="fw-semibold text-muted">{{ __('common.document_number') }}</div>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_document_view_details" role="button" aria-expanded="false" aria-controls="kt_document_view_details">{{ __('companies.details') }}
                                    <span class="ms-2 rotate-180">
                                        <i class="fa-solid fa-down fs-3"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--begin::Details content-->
                            <div id="kt_document_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('common.document_type') }}</div>
                                    <div class="text-gray-600">{{ app()->getLocale() === 'ar' ? $document->documentType->name_ar : $document->documentType->name_en }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('common.status') }}</div>
                                    <div class="text-gray-600">
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
                                    </div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.issue_date') }}</div>
                                    <div class="text-gray-600">{{ $document->getCustomFieldValue('issue_date') ? \Carbon\Carbon::parse($document->getCustomFieldValue('issue_date'))->format('Y-m-d') : __('common.n_a') }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.expiry_date') }}</div>
                                    <div class="text-gray-600">{{ $document->getCustomFieldValue('expiry_date') ? \Carbon\Carbon::parse($document->getCustomFieldValue('expiry_date'))->format('Y-m-d') : __('common.n_a') }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.issuing_authority') }}</div>
                                    <div class="text-gray-600">{{ $document->getCustomFieldValue('issuing_authority') ?? __('common.n_a') }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.reminder_settings') }}</div>
                                    <div class="text-gray-600">
                                        @if($document->enable_reminder && $document->reminder_days)
                                            <span class="badge badge-light-success">@lang('common.enabled')</span>
                                            <br><small class="text-muted">{{ $document->reminder_days }} @lang('documents.days_before_expiry')</small>
                                        @else
                                            <span class="badge badge-light-danger">@lang('common.disabled')</span>
                                        @endif
                                    </div>
                                    <!--end::Details item-->
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
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_document_view_overview_tab">{{ __('common.overview') }}</a>
                        </li>
                        <!--end:::Tab item-->
                        @if($document->hasFile())
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_document_view_file_tab">{{ __('common.file') }}</a>
                        </li>
                        <!--end:::Tab item-->
                        @endif
                        @if($document->custom_fields)
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_document_view_additional_tab">{{ __('companies.additional_info') }}</a>
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
                                        <h2>{{ __('companies.document_information') }}</h2>
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
                                                    <td class="text-muted">{{ __('common.document_number') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->getCustomFieldValue('document_number') ?? __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.issue_date') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->getCustomFieldValue('issue_date') ? \Carbon\Carbon::parse($document->getCustomFieldValue('issue_date'))->format('Y-m-d') : __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.expiry_date') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->getCustomFieldValue('expiry_date') ? \Carbon\Carbon::parse($document->getCustomFieldValue('expiry_date'))->format('Y-m-d') : __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.issuing_authority') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->getCustomFieldValue('issuing_authority') ?? __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.place_of_issue') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->getCustomFieldValue('place_of_issue') ?? __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.reference_number') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->getCustomFieldValue('reference_number') ?? __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.fees_amount') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->getCustomFieldValue('fees_amount') ? number_format($document->getCustomFieldValue('fees_amount'), 2) . ' SAR' : __('common.n_a') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.reminder_settings') }}</td>
                                                    <td class="fw-bold text-end">
                                                        @if($document->enable_reminder && $document->reminder_days)
                                                            <span class="badge badge-light-success">@lang('common.enabled')</span>
                                                            <br><small class="text-muted">{{ $document->reminder_days }} @lang('documents.days_before_expiry')</small>
                                                        @else
                                                            <span class="badge badge-light-danger">@lang('common.disabled')</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('common.created_at') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->created_at->format('Y-m-d H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('common.last_updated') }}</td>
                                                    <td class="fw-bold text-end">{{ $document->updated_at->format('Y-m-d H:i') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                    @if($document->getCustomFieldValue('notes'))
                                    <!--begin::Notes-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <div class="mb-0">
                                        <h4 class="text-gray-800 mb-3">{{ __('companies.notes') }}</h4>
                                        <div class="text-gray-600 fs-6">{{ $document->getCustomFieldValue('notes') }}</div>
                                    </div>
                                    <!--end::Notes-->
                                    @endif
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->

                        @if($document->hasFile())
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_document_view_file_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('common.document_file') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    @php
                                        $fileInfo = $document->getFileInfo();
                                        $fileExtension = strtolower($fileInfo['extension'] ?? '');
                                    @endphp
                                    <div class="d-flex flex-column align-items-center">
                                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                            <img src="{{ $fileInfo['url'] }}" alt="{{ $fileInfo['original_filename'] }}" class="img-fluid mb-5" style="max-width: 100%; max-height: 500px;">
                                        @else
                                            <div class="symbol symbol-150px symbol-circle mb-5">
                                                <div class="symbol-label fs-1 fw-bold text-primary">
                                                    @if($fileExtension === 'pdf')
                                                        <i class="fa-solid fa-file-pdf"></i>
                                                    @else
                                                        <i class="fa-solid fa-file"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <h3 class="text-gray-800 fw-bold mb-3">{{ $fileInfo['original_filename'] }}</h3>
                                        <div class="text-muted mb-5">
                                            <span class="badge badge-light-info me-2">{{ strtoupper($fileExtension) }}</span>
                                            <span class="badge badge-light-secondary">{{ $document->formatted_file_size }}</span>
                                        </div>
                                        <a href="{{ route('admin.companies.documents.download', [$company, $document]) }}" class="btn btn-primary">
                                            <i class="fa-solid fa-download me-2"></i>{{ __('common.download') }}
                                        </a>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                        @endif

                        @if($document->custom_fields)
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_document_view_additional_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('companies.additional_information') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    @if($document->documentType->custom_fields)
                                        @foreach($document->documentType->custom_fields as $field)
                                            @php
                                                $fieldKey = $field['key'];
                                                $fieldName = app()->getLocale() === 'ar' ? $field['name_ar'] : $field['name_en'];
                                                $fieldValue = $document->getCustomFieldValue($fieldKey);
                                                $fieldType = $field['type'];
                                            @endphp
                                            @if($fieldValue)
                                                <div class="d-flex flex-column mb-5">
                                                    <div class="fw-bold text-gray-800 mb-2">{{ $fieldName }}</div>
                                                    <div class="text-gray-600">
                                                        @if($fieldType === 'file')
                                                            @php
                                                                $fileData = is_string($fieldValue) ? json_decode($fieldValue, true) : $fieldValue;
                                                            @endphp
                                                            @if($fileData && isset($fileData['file_path']))
                                                                <a href="{{ asset('storage/' . $fileData['file_path']) }}" target="_blank" class="btn btn-sm btn-light-primary">
                                                                    <i class="fa-solid fa-download me-1"></i>{{ $fileData['original_filename'] ?? 'Download' }}
                                                                </a>
                                                            @else
                                                                {{ __('common.n_a') }}
                                                            @endif
                                                        @elseif($fieldType === 'date')
                                                            {{ \Carbon\Carbon::parse($fieldValue)->format('Y-m-d') }}
                                                        @elseif($fieldType === 'select')
                                                            @php
                                                                $selectedOption = collect($field['options'] ?? [])->firstWhere('option_value', $fieldValue);
                                                                $optionText = $selectedOption ? (app()->getLocale() === 'ar' ? $selectedOption['option_ar'] : $selectedOption['option_en']) : $fieldValue;
                                                            @endphp
                                                            {{ $optionText }}
                                                        @else
                                                            {{ $fieldValue }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
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
@endsection
