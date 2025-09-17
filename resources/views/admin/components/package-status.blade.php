@if(isset($packageStatus) && $packageStatus['has_package'])
<!--begin::Package Status Card-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">{{ __('common.package_information') }}</span>
            <span class="text-muted mt-1 fw-semibold fs-7">{{ __('packages.current_package_status') }}</span>
        </h3>
        @if($packageStatus['is_expired'])
        <div class="card-toolbar">
            <span class="badge badge-light-danger fs-6">{{ __('common.expired') }}</span>
        </div>
        @else
        <div class="card-toolbar">
            <span class="badge badge-light-success fs-6">{{ __('common.active') }}</span>
        </div>
        @endif
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
        <!--begin::Package Details-->
        <div class="row mb-7">
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <span class="fw-semibold fs-7 text-gray-600 me-2">{{ __('packages.name') }}:</span>
                    <span class="fw-bold fs-7 text-gray-800">{{ $packageStatus['package_name'] }}</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <span class="fw-semibold fs-7 text-gray-600 me-2">{{ __('common.end_date') }}:</span>
                    <span class="fw-bold fs-7 text-gray-800">
                        {{ $packageStatus['expiry_date'] ? \Carbon\Carbon::parse($packageStatus['expiry_date'])->format('M d, Y') : __('common.n_a') }}
                    </span>
                </div>
            </div>
        </div>
        <!--end::Package Details-->

        <!--begin::Usage Statistics-->
        <div class="row">
            <!--begin::Employees-->
            <div class="col-lg-4">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted text-gray-800 me-2">{{ $packageStatus['limits']['employees']['current'] }}</div>
                        <div class="fs-7 fw-semibold text-gray-600">
                            / {{ $packageStatus['limits']['employees']['unlimited'] ? __('common.unlimited') : $packageStatus['limits']['employees']['max'] }}
                        </div>
                    </div>
                    <div class="fw-semibold fs-6 text-gray-500">{{ __('common.employees') }}</div>
                    @if(!$packageStatus['limits']['employees']['can_add'] && !$packageStatus['limits']['employees']['unlimited'])
                    <div class="fw-bold fs-8 text-danger mt-1">{{ __('packages.validation.limit_reached') }}</div>
                    @endif
                </div>
            </div>
            <!--end::Employees-->
            
            <!--begin::Employee Documents-->
            <div class="col-lg-4">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted text-gray-800 me-2">{{ $packageStatus['limits']['employee_documents']['current'] }}</div>
                        <div class="fs-7 fw-semibold text-gray-600">
                            / {{ $packageStatus['limits']['employee_documents']['unlimited'] ? __('common.unlimited') : $packageStatus['limits']['employee_documents']['max'] }}
                        </div>
                    </div>
                    <div class="fw-semibold fs-6 text-gray-500">{{ __('packages.max_employee_documents') }}</div>
                    @if(!$packageStatus['limits']['employee_documents']['can_add'] && !$packageStatus['limits']['employee_documents']['unlimited'])
                    <div class="fw-bold fs-8 text-danger mt-1">{{ __('packages.validation.limit_reached') }}</div>
                    @endif
                </div>
            </div>
            <!--end::Employee Documents-->
            
            <!--begin::Company Documents-->
            <div class="col-lg-4">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted text-gray-800 me-2">{{ $packageStatus['limits']['company_documents']['current'] }}</div>
                        <div class="fs-7 fw-semibold text-gray-600">
                            / {{ $packageStatus['limits']['company_documents']['unlimited'] ? __('common.unlimited') : $packageStatus['limits']['company_documents']['max'] }}
                        </div>
                    </div>
                    <div class="fw-semibold fs-6 text-gray-500">{{ __('packages.max_company_documents') }}</div>
                    @if(!$packageStatus['limits']['company_documents']['can_add'] && !$packageStatus['limits']['company_documents']['unlimited'])
                    <div class="fw-bold fs-8 text-danger mt-1">{{ __('packages.validation.limit_reached') }}</div>
                    @endif
                </div>
            </div>
            <!--end::Company Documents-->
        </div>
        <!--end::Usage Statistics-->

        <!--begin::Expiry Warning-->
        @if($packageStatus['days_until_expiry'] !== null && $packageStatus['days_until_expiry'] <= 30 && $packageStatus['days_until_expiry'] > 0)
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mt-5">
            <i class="fas fa-exclamation-triangle fs-2tx text-warning me-4"></i>
            <div class="d-flex flex-stack flex-grow-1">
                <div class="fw-semibold">
                    <div class="fs-6 text-gray-700">
                        {{ __('packages.validation.package_expiring_soon', ['days' => $packageStatus['days_until_expiry']]) }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!--end::Expiry Warning-->
    </div>
    <!--end::Body-->
</div>
<!--end::Package Status Card-->
@elseif(isset($packageStatus) && !$packageStatus['has_package'])
<!--begin::No Package Warning-->
<div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6 mb-5">
    <i class="fas fa-exclamation-circle fs-2tx text-danger me-4"></i>
    <div class="d-flex flex-stack flex-grow-1">
        <div class="fw-semibold">
            <h4 class="text-gray-900 fw-bold">{{ __('packages.validation.no_active_package') }}</h4>
            <div class="fs-6 text-gray-700">
                {{ __('packages.validation.assign_package_to_continue') }}
            </div>
        </div>
        @can('assign_packages_to_clients')
        <div class="ms-5">
            <a href="{{ route('admin.companies.packages.create', $company ?? '') }}" class="btn btn-sm btn-primary">
                {{ __('client_packages.assign_package') }}
            </a>
        </div>
        @endcan
    </div>
</div>
<!--end::No Package Warning-->
@endif

<!--begin::Additional Warnings-->
@if(isset($warnings) && count($warnings) > 0)
@foreach($warnings as $warning)
<div class="notice d-flex bg-light-{{ $warning['severity'] }} rounded border-{{ $warning['severity'] }} border border-dashed p-6 mb-3">
    <i class="fas fa-{{ $warning['severity'] === 'danger' ? 'exclamation-circle' : 'exclamation-triangle' }} fs-2tx text-{{ $warning['severity'] }} me-4"></i>
    <div class="d-flex flex-stack flex-grow-1">
        <div class="fw-semibold">
            <div class="fs-6 text-gray-700">{{ $warning['message'] }}</div>
        </div>
    </div>
</div>
@endforeach
@endif
<!--end::Additional Warnings-->
