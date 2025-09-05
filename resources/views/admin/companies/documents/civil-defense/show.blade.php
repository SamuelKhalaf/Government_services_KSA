@extends('admin.layouts.master')

@section('title', __('Civil Defense License') . ' - ' . $civilDefenseLicense->license_number)

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
                    @lang('common.civil_defense_license')
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
                        <a href="{{ route('admin.companies.show', $company) }}" class="text-muted text-hover-primary">{{ $company->company_name_en }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ $civilDefenseLicense->license_number }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if($civilDefenseLicense->certificate_file_path)
                    <a href="{{ asset('storage/' . $civilDefenseLicense->certificate_file_path) }}" class="btn btn-sm fw-bold btn-success" target="_blank">
                        <i class="ki-duotone ki-file-down fs-2"></i>{{ __('companies.download_certificate') }}
                    </a>
                @endif
                <a href="{{ route('admin.companies.civil-defense-licenses.edit', [$company, $civilDefenseLicense]) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-pencil fs-2"></i>{{ __('companies.edit_license') }}
                </a>
                <button type="button" class="btn btn-sm fw-bold btn-danger" data-bs-toggle="modal" data-bs-target="#delete_license_modal">
                    <i class="ki-duotone ki-trash fs-2"></i>@lang('common.delete')
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
                                    <div class="symbol-label fs-3 bg-light-success text-success">
                                        <i class="ki-duotone ki-shield-tick fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">{{ $civilDefenseLicense->license_number }}</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="fs-5 fw-semibold text-muted mb-6">@lang('common.civil_defense_license')</div>
                                <!--end::Position-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap flex-center">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            @php
                                                $daysToExpiry = $civilDefenseLicense->expiry_date ?
                                                    now()->diffInDays($civilDefenseLicense->expiry_date, false) : null;
                                            @endphp
                                            @if($daysToExpiry !== null)
                                                @if($daysToExpiry < 0)
                                                    <span class="text-danger">{{ __('companies.expired') }}</span>
                                                @elseif($daysToExpiry <= 30)
                                                    <span class="text-warning">{{ $daysToExpiry }} {{ __('companies.days') }}</span>
                                                @else
                                                    <span class="text-success">{{ $daysToExpiry }} {{ __('companies.days') }}</span>
                                                @endif
                                            @else
                                                <span class="text-muted">{{ __('companies.na') }}</span>
                                            @endif
                                        </div>
                                        <div class="fw-semibold text-muted">{{ __('companies.until_expiry') }}</div>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_license_view_details" role="button" aria-expanded="false" aria-controls="kt_license_view_details">{{ __('companies.details') }}
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-duotone ki-down fs-3"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--begin::Details content-->
                            <div id="kt_license_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('common.company') }}</div>
                                    <div class="text-gray-600">
                                        <a href="{{ route('admin.companies.show', $company) }}" class="text-gray-600 text-hover-primary">{{ $company->company_name_en }}</a>
                                    </div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.authority') }}</div>
                                    <div class="text-gray-600">{{ $civilDefenseLicense->authority }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.issue_date') }}</div>
                                    <div class="text-gray-600">{{ $civilDefenseLicense->issue_date?->format('Y-m-d') ?? __('N/A') }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.expiry_date') }}</div>
                                    <div class="text-gray-600">
                                        {{ $civilDefenseLicense->expiry_date?->format('Y-m-d') ?? __('N/A') }}
                                        @if($civilDefenseLicense->expiry_date)
                                            @if($daysToExpiry < 0)
                                                <br><span class="badge badge-light-danger mt-1">{{ __('companies.expired') }}</span>
                                            @elseif($daysToExpiry <= 30)
                                                <br><span class="badge badge-light-warning mt-1">{{ __('companies.expiring_soon') }}</span>
                                            @else
                                                <br><span class="badge badge-light-success mt-1">{{ __('companies.valid') }}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.safety_status') }}</div>
                                    <div class="text-gray-600">
                                        @switch($civilDefenseLicense->safety_status)
                                            @case('compliant')
                                                <span class="badge badge-light-success">{{ __('companies.compliant') }}</span>
                                                @break
                                            @case('non_compliant')
                                                <span class="badge badge-light-danger">{{ __('companies.non_compliant') }}</span>
                                                @break
                                            @case('pending')
                                                <span class="badge badge-light-warning">{{ __('companies.pending_review') }}</span>
                                                @break
                                            @case('under_review')
                                                <span class="badge badge-light-info">{{ __('companies.under_review') }}</span>
                                                @break
                                            @default
                                                <span class="badge badge-light-secondary">{{ ucfirst($civilDefenseLicense->safety_status) }}</span>
                                        @endswitch
                                    </div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.inspection_status') }}</div>
                                    <div class="text-gray-600">
                                        @switch($civilDefenseLicense->inspection_status)
                                            @case('passed')
                                                <span class="badge badge-light-success">{{ __('companies.passed') }}</span>
                                                @break
                                            @case('failed')
                                                <span class="badge badge-light-danger">{{ __('companies.failed') }}</span>
                                                @break
                                            @case('pending')
                                                <span class="badge badge-light-warning">{{ __('companies.pending') }}</span>
                                                @break
                                            @case('not_required')
                                                <span class="badge badge-light-secondary">{{ __('companies.not_required') }}</span>
                                                @break
                                            @default
                                                <span class="badge badge-light-secondary">{{ ucfirst($civilDefenseLicense->inspection_status) }}</span>
                                        @endswitch
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
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{ __('companies.license_information') }}</h2>
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
                                            <td class="text-muted">{{ __('companies.license_number') }}</td>
                                            <td class="fw-bold text-end">{{ $civilDefenseLicense->license_number }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.issuing_authority') }}</td>
                                            <td class="fw-bold text-end">{{ $civilDefenseLicense->authority }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.activity_classification') }}</td>
                                            <td class="fw-bold text-end">{{ $civilDefenseLicense->activity_classification }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.facility_type') }}</td>
                                            <td class="fw-bold text-end">{{ ucfirst(str_replace('_', ' ', $civilDefenseLicense->facility_type)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.total_area') }}</td>
                                            <td class="fw-bold text-end">{{ number_format($civilDefenseLicense->total_area, 2) }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.number_of_floors') }}</td>
                                            <td class="fw-bold text-end">{{ $civilDefenseLicense->floors }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.issue_date') }}</td>
                                            <td class="fw-bold text-end">{{ $civilDefenseLicense->issue_date?->format('Y-m-d') ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.expiry_date') }}</td>
                                            <td class="fw-bold text-end">
                                                {{ $civilDefenseLicense->expiry_date?->format('Y-m-d') ?? __('N/A') }}
                                                @if($civilDefenseLicense->expiry_date)
                                                    @if($daysToExpiry < 0)
                                                        <span class="badge badge-light-danger ms-2">{{ __('companies.expired') }}</span>
                                                    @elseif($daysToExpiry <= 30)
                                                        <span class="badge badge-light-warning ms-2">{{ __('companies.expiring_soon') }}</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @if($civilDefenseLicense->last_inspection_date)
                                            <tr>
                                                <td class="text-muted">{{ __('companies.last_inspection_date') }}</td>
                                                <td class="fw-bold text-end">{{ $civilDefenseLicense->last_inspection_date->format('Y-m-d') }}</td>
                                            </tr>
                                        @endif
                                        @if($civilDefenseLicense->next_inspection_date)
                                            <tr>
                                                <td class="text-muted">{{ __('companies.next_inspection_date') }}</td>
                                                <td class="fw-bold text-end">{{ $civilDefenseLicense->next_inspection_date->format('Y-m-d') }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-muted">{{ __('companies.created_at') }}</td>
                                            <td class="fw-bold text-end">{{ $civilDefenseLicense->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.last_updated') }}</td>
                                            <td class="fw-bold text-end">{{ $civilDefenseLicense->updated_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->

                            @if($civilDefenseLicense->notes)
                                <!--begin::Notes section-->
                                <div class="mt-10">
                                    <h4 class="text-gray-800 mb-5">{{ __('companies.notes') }}</h4>
                                    <div class="bg-light-info rounded p-5">
                                        <div class="text-gray-700">{!! nl2br(e($civilDefenseLicense->notes)) !!}</div>
                                    </div>
                                </div>
                                <!--end::Notes section-->
                            @endif

                            @if($civilDefenseLicense->certificate_file_path)
                                <!--begin::Certificate section-->
                                <div class="mt-10">
                                    <h4 class="text-gray-800 mb-5">{{ __('companies.certificate_file') }}</h4>
                                    <div class="bg-light-primary rounded p-5 text-center">
                                        @php
                                            $fileExtension = strtolower(pathinfo($civilDefenseLicense->certificate_file_path, PATHINFO_EXTENSION));
                                        @endphp

                                        @if($fileExtension === 'pdf')
                                            <i class="ki-duotone ki-file-text fs-3x text-primary mb-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="fw-bold text-gray-700 fs-4">{{ __('companies.pdf_certificate') }}</div>
                                        @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                            <i class="ki-duotone ki-picture fs-3x text-primary mb-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="fw-bold text-gray-700 fs-4">{{ __('companies.image_certificate') }}</div>
                                        @else
                                            <i class="ki-duotone ki-file fs-3x text-primary mb-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="fw-bold text-gray-700 fs-4">{{ __('companies.certificate_file') }}</div>
                                        @endif

                                        <div class="text-muted mt-2">{{ __('companies.click_download_button_to_view') }}</div>
                                    </div>
                                </div>
                                <!--end::Certificate section-->
                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
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
<div class="modal fade" id="delete_license_modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_delete_license_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ __('companies.delete_civil_defense_license') }}</h2>
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
                <form id="kt_modal_delete_license_form" class="form" action="{{ route('admin.companies.civil-defense-licenses.destroy', [$company, $civilDefenseLicense]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!--begin::Heading-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">{{ __('companies.are_you_sure_delete_civil_defense_license') }}</label>
                        <!--end::Label-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">
                            {{ __('companies.license_number') }}: <strong>{{ $civilDefenseLicense->license_number }}</strong><br>
                            {{ __('companies.authority') }}: <strong>{{ $civilDefenseLicense->authority }}</strong><br>
                            {{ __('companies.this_action_cannot_be_undone') }}
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">@lang('common.cancel')</button>
                        <button type="submit" class="btn btn-danger">
                            <span class="indicator-label">{{ __('companies.delete_license') }}</span>
                            <span class="indicator-progress">{{ __('companies.please_wait') }}
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
