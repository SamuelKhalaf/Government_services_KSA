@extends('admin.layouts.master')

@section('title', __('companies.municipality_license') . ' - ' . $municipalityLicense->license_number)

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
                    @lang('common.municipality_license')
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
                    <li class="breadcrumb-item text-muted">{{ $municipalityLicense->license_number }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if($municipalityLicense->certificate_file_path)
                    <a href="{{ asset('storage/' . $municipalityLicense->certificate_file_path) }}" class="btn btn-sm fw-bold btn-success" target="_blank">
                        <i class="fas fa-download fs-2"></i>{{ __('companies.download_certificate') }}
                    </a>
                @endif
                @if(auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_COMPANY_DOCUMENTS->value))
                <a href="{{ route('admin.companies.municipality-licenses.edit', [$company, $municipalityLicense]) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fas fa-edit fs-2"></i>{{ __('companies.edit_license') }}
                </a>
                @endif
                @if(auth()->user()->can(\App\Enums\PermissionEnum::DELETE_COMPANY_DOCUMENTS->value))
                <button type="button" class="btn btn-sm fw-bold btn-danger" data-bs-toggle="modal" data-bs-target="#delete_license_modal">
                    <i class="fas fa-trash fs-2"></i>@lang('common.delete')
                </button>
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
                                        <i class="fas fa-city fs-1"></i>
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">{{ $municipalityLicense->license_number }}</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="fs-5 fw-semibold text-muted mb-6">@lang('common.municipality_license')</div>
                                <!--end::Position-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap flex-center">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            @php
                                                $daysToExpiry = $municipalityLicense->expiry_date ?
                                                    now()->diffInDays($municipalityLicense->expiry_date, false) : null;
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
                                        <i class="fas fa-chevron-down fs-3"></i>
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
                                    <div class="fw-bold mt-5">{{ __('companies.municipality') }}</div>
                                    <div class="text-gray-600">{{ $municipalityLicense->municipality_name }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.license_type') }}</div>
                                    <div class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $municipalityLicense->license_type)) }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.issue_date') }}</div>
                                    <div class="text-gray-600">{{ $municipalityLicense->issue_date?->format('Y-m-d') ?? __('N/A') }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.expiry_date') }}</div>
                                    <div class="text-gray-600">
                                        {{ $municipalityLicense->expiry_date?->format('Y-m-d') ?? __('N/A') }}
                                        @if($municipalityLicense->expiry_date)
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
                                    <div class="fw-bold mt-5">{{ __('companies.area') }}</div>
                                    <div class="text-gray-600">{{ number_format($municipalityLicense->area, 2) }} m²</div>
                                    <!--end::Details item-->
                                    @if($municipalityLicense->license_fees)
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{ __('companies.license_fees') }}</div>
                                        <div class="text-gray-600">{{ number_format($municipalityLicense->license_fees, 2) }} SAR</div>
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
                                            <td class="fw-bold text-end">{{ $municipalityLicense->license_number }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.municipality_name') }}</td>
                                            <td class="fw-bold text-end">{{ $municipalityLicense->municipality_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.license_type') }}</td>
                                            <td class="fw-bold text-end">{{ ucfirst(str_replace('_', ' ', $municipalityLicense->license_type)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.land_use_type') }}</td>
                                            <td class="fw-bold text-end">{{ ucfirst(str_replace('_', ' ', $municipalityLicense->land_use_type)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.location_code') }}</td>
                                            <td class="fw-bold text-end">{{ $municipalityLicense->location_code }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.area') }}</td>
                                            <td class="fw-bold text-end">{{ number_format($municipalityLicense->area, 2) }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.zone_classification') }}</td>
                                            <td class="fw-bold text-end">{{ $municipalityLicense->zone_classification }}</td>
                                        </tr>
                                        @if($municipalityLicense->building_permit_number)
                                            <tr>
                                                <td class="text-muted">{{ __('companies.building_permit_number') }}</td>
                                                <td class="fw-bold text-end">{{ $municipalityLicense->building_permit_number }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-muted">{{ __('companies.issue_date') }}</td>
                                            <td class="fw-bold text-end">{{ $municipalityLicense->issue_date?->format('Y-m-d') ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.expiry_date') }}</td>
                                            <td class="fw-bold text-end">
                                                {{ $municipalityLicense->expiry_date?->format('Y-m-d') ?? __('N/A') }}
                                                @if($municipalityLicense->expiry_date)
                                                    @if($daysToExpiry < 0)
                                                        <span class="badge badge-light-danger ms-2">{{ __('companies.expired') }}</span>
                                                    @elseif($daysToExpiry <= 30)
                                                        <span class="badge badge-light-warning ms-2">{{ __('companies.expiring_soon') }}</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @if($municipalityLicense->license_fees)
                                            <tr>
                                                <td class="text-muted">{{ __('companies.license_fees') }}</td>
                                                <td class="fw-bold text-end">{{ number_format($municipalityLicense->license_fees, 2) }} SAR</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-muted">{{ __('companies.created_at') }}</td>
                                            <td class="fw-bold text-end">{{ $municipalityLicense->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('companies.last_updated') }}</td>
                                            <td class="fw-bold text-end">{{ $municipalityLicense->updated_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->

                            <!--begin::Activity Description-->
                            @if($municipalityLicense->activity_desc)
                                <div class="mt-10">
                                    <h4 class="text-gray-800 mb-5">{{ __('companies.activity_description') }}</h4>
                                    <div class="bg-light-primary rounded p-5">
                                        <div class="text-gray-700">{!! nl2br(e($municipalityLicense->activity_desc)) !!}</div>
                                    </div>
                                </div>
                            @endif
                            <!--end::Activity Description-->

                            <!--begin::Conditions-->
                            @if($municipalityLicense->conditions)
                                <div class="mt-10">
                                    <h4 class="text-gray-800 mb-5">{{ __('companies.conditions_requirements') }}</h4>
                                    <div class="bg-light-warning rounded p-5">
                                        <div class="text-gray-700">{!! nl2br(e($municipalityLicense->conditions)) !!}</div>
                                    </div>
                                </div>
                            @endif
                            <!--end::Conditions-->

                            <!--begin::Notes-->
                            @if($municipalityLicense->notes)
                                <div class="mt-10">
                                    <h4 class="text-gray-800 mb-5">{{ __('companies.notes') }}</h4>
                                    <div class="bg-light-info rounded p-5">
                                        <div class="text-gray-700">{!! nl2br(e($municipalityLicense->notes)) !!}</div>
                                    </div>
                                </div>
                            @endif
                            <!--end::Notes-->

                            <!--begin::Certificate-->
                            @if($municipalityLicense->certificate_file_path)
                                <div class="mt-10">
                                    <h4 class="text-gray-800 mb-5">{{ __('companies.certificate_file') }}</h4>
                                    <div class="bg-light-info rounded p-5 text-center">
                                        @php
                                            $fileExtension = strtolower(pathinfo($municipalityLicense->certificate_file_path, PATHINFO_EXTENSION));
                                        @endphp

                                        @if($fileExtension === 'pdf')
                                            <i class="fas fa-file-alt fs-3x text-info mb-3"></i>
                                            <div class="fw-bold text-gray-700 fs-4">{{ __('companies.pdf_certificate') }}</div>
                                        @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                            <i class="fas fa-image fs-3x text-info mb-3"></i>
                                            <div class="fw-bold text-gray-700 fs-4">{{ __('companies.image_certificate') }}</div>
                                        @else
                                            <i class="fas fa-file fs-3x text-info mb-3"></i>
                                            <div class="fw-bold text-gray-700 fs-4">{{ __('companies.certificate_file') }}</div>
                                        @endif

                                        <div class="text-muted mt-2">{{ __('companies.click_download_button_to_view') }}</div>
                                    </div>
                                </div>
                            @endif
                            <!--end::Certificate-->
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
                <h2 class="fw-bold">{{ __('companies.delete_municipality_license') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_delete_license_form" class="form" action="{{ route('admin.companies.municipality-licenses.destroy', [$company, $municipalityLicense]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!--begin::Heading-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">{{ __('companies.are_you_sure_delete_municipality_license') }}</label>
                        <!--end::Label-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">
                            {{ __('companies.license_number') }}: <strong>{{ $municipalityLicense->license_number }}</strong><br>
                            {{ __('companies.municipality') }}: <strong>{{ $municipalityLicense->municipality_name }}</strong><br>
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
