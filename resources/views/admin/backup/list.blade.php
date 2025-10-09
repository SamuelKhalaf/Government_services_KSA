@extends('admin.layouts.master')

@section('title')
    @lang('backup.stored_backups')
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
                        @lang('backup.stored_backups')
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.backup.index') }}" class="text-muted text-hover-primary">@lang('backup.database_backup')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">@lang('backup.stored_backups')</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.backup.index') }}" class="btn btn-sm fw-bold btn-primary">
                        <i class="ki-duotone ki-arrow-left fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        @lang('backup.back_to_backup')
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
                            <h3 class="fw-bold m-0">@lang('backup.stored_backups')</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        @if(count($backups) > 0)
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted">
                                            <th class="min-w-200px">@lang('backup.filename')</th>
                                            <th class="min-w-100px">@lang('backup.file_size')</th>
                                            <th class="min-w-150px">@lang('backup.created_at')</th>
                                            <th class="min-w-100px text-end">@lang('common.actions')</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach($backups as $backup)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <span class="symbol-label bg-light-primary">
                                                                <i class="fa-solid fa-database fs-2x text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <span class="text-dark fw-bold text-hover-primary fs-6">{{ $backup['filename'] }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-bold d-block fs-6">{{ number_format($backup['size'] / 1024, 2) }} KB</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted fw-semibold text-muted d-block fs-7">{{ $backup['created_at']->format('Y-m-d H:i:s') }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <!--begin::Download-->
                                                        <a href="{{ route('admin.backup.download', $backup['filename']) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="@lang('backup.download')">
                                                            <i class="fa-solid fa-download fs-3"></i>
                                                        </a>
                                                        <!--end::Download-->
                                                        <!--begin::Delete-->
                                                        <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="deleteBackup('{{ $backup['filename'] }}')" title="@lang('backup.delete')">
                                                            <i class="fa-solid fa-trash fs-3"></i>
                                                        </button>
                                                        <!--end::Delete-->
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        @else
                            <!--begin::Empty state-->
                            <div class="text-center py-10">
                                <div class="mb-5">
                                    <i class="fa-solid fa-database fs-2x text-primary"></i>
                                </div>
                                <h3 class="text-gray-800 fw-bold mb-3">@lang('backup.no_backups_found')</h3>
                                <p class="text-gray-600 fs-6 mb-5">@lang('backup.no_backups_description')</p>
                                <a href="{{ route('admin.backup.index') }}" class="btn btn-primary">
                                    <i class="fa-solid fa-plus fs-2"></i>
                                    @lang('backup.create_first_backup')
                                </a>
                            </div>
                            <!--end::Empty state-->
                        @endif
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

    <!--begin::Delete Modal-->
    <div class="modal fade" id="deleteBackupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">@lang('backup.delete_backup')</h2>
                    <div id="deleteBackupModalClose" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <i class="fa-solid fa-xmark fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <div class="text-center">
                        <i class="fa-solid fa-exclamation-triangle fs-3x text-warning mb-5"></i>
                        <h3 class="fw-bold text-gray-900 mb-5">@lang('backup.delete_confirmation_title')</h3>
                        <p class="fw-semibold fs-6 text-gray-500 mb-7">@lang('backup.delete_confirmation_message')</p>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">@lang('common.cancel')</button>
                        <form id="deleteBackupForm" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">@lang('backup.delete_backup')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Delete Modal-->
@endsection

@section('scripts')
    <script>
        function deleteBackup(filename) {
            const form = document.getElementById('deleteBackupForm');
            form.action = '{{ route("admin.backup.delete", ":filename") }}'.replace(':filename', filename);
            
            const modal = new bootstrap.Modal(document.getElementById('deleteBackupModal'));
            modal.show();
        }
    </script>
@endsection
