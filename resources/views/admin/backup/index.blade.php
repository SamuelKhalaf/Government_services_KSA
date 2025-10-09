@extends('admin.layouts.master')

@section('title')
    @lang('backup.database_backup')
@endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        @lang('backup.database_backup')
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">@lang('navigation.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">@lang('backup.database_backup')</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
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
                            <h3 class="fw-bold m-0">@lang('backup.backup_management')</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Alert-->
                        <div class="alert alert-info d-flex align-items-center p-5 mb-10">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-information-5 fs-2hx text-info me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h4 class="mb-1 text-info">@lang('backup.backup_info_title')</h4>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <span>@lang('backup.backup_info_description')</span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Alert-->

                        <!--begin::Actions-->
                        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-150px" style="background-color: #F1416C;background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">@lang('backup.download_backup')</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">@lang('backup.download_backup_description')</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-end flex-column">
                                        <!--begin::Button-->
                                        <form action="{{ route('admin.backup.create') }}" method="POST" class="d-flex justify-content-end">
                                            @csrf
                                            <button type="submit" class="btn btn-light btn-sm">
                                                <i class="fa-solid fa-download fs-2"></i>
                                                @lang('backup.download_now')
                                            </button>
                                        </form>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-150px" style="background-color: #50CD89;background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">@lang('backup.store_backup')</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">@lang('backup.store_backup_description')</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-end flex-column">
                                        <!--begin::Button-->
                                        <form action="{{ route('admin.backup.store') }}" method="POST" class="d-flex justify-content-end">
                                            @csrf
                                            <button type="submit" class="btn btn-light btn-sm">
                                                <i class="fa-solid fa-save fs-2"></i>
                                                @lang('backup.store_now')
                                            </button>
                                        </form>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-150px" style="background-color: #7239EA;background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">@lang('backup.view_backups')</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">@lang('backup.view_backups_description')</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-end flex-column">
                                        <!--begin::Button-->
                                        <a href="{{ route('admin.backup.list') }}" class="btn btn-light btn-sm">
                                            <i class="fa-solid fa-list fs-2"></i>
                                            @lang('backup.view_list')
                                        </a>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                            </div>
                        </div>
                        <!--end::Actions-->

                        <!--begin::Database Info-->
                        <div class="card card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="fw-bold m-0">@lang('backup.database_info')</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-5">
                                            <div class="symbol symbol-50px me-5">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="fa-solid fa-database fs-2x text-primary"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold fs-6 text-gray-800">@lang('backup.database_name')</span>
                                                <span class="fw-bold fs-6 text-gray-600">{{ config('database.connections.' . config('database.default') . '.database') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-5">
                                            <div class="symbol symbol-50px me-5">
                                                <span class="symbol-label bg-light-success">
                                                    <i class="fa-solid fa-server fs-2x text-success"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold fs-6 text-gray-800">@lang('backup.database_host')</span>
                                                <span class="fw-bold fs-6 text-gray-600">{{ config('database.connections.' . config('database.default') . '.host') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Database Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
