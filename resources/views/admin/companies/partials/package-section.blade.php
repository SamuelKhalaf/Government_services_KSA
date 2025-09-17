<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __('client_packages.package_assignment') }}</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        @if($company->current_package)
            <!--begin::Package Status Warnings-->
            @if(isset($warnings) && count($warnings) > 0)
                @foreach($warnings as $warning)
                <div class="notice d-flex bg-light-{{ $warning['severity'] }} rounded border-{{ $warning['severity'] }} border border-dashed p-6 mb-5">
                    <i class="fas fa-{{ $warning['severity'] === 'danger' ? 'exclamation-circle' : 'exclamation-triangle' }} fs-2tx text-{{ $warning['severity'] }} me-4"></i>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <div class="fs-6 text-gray-700">{{ $warning['message'] }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            <!--end::Package Status Warnings-->

            <!--begin::Current Package Overview-->
            <div class="row mb-10">
                <div class="col-12">
                    <h4 class="fw-bold mb-5">{{ __('client_packages.current_package') }}</h4>
                    
                    <!--begin::Package Header Card-->
                    <div class="card {{ $company->current_package->isActive() ? 'bg-light-success' : ($company->current_package->isExpired() ? 'bg-light-danger' : 'bg-light-warning') }} mb-5">
                        <div class="card-body py-4">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-box fs-2x text-primary me-3"></i>
                                        <div>
                                            <h3 class="fw-bold text-gray-900 mb-1">{{ $company->current_package->package->name }}</h3>
                                            <div class="fw-semibold fs-6 text-gray-600">
                                                {{ number_format($company->current_package->package->price, 2) }} {{ __('common.currency') }} / {{ $company->current_package->package->duration }} {{ __('common.months') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <div class="fw-semibold text-gray-600 fs-7 mb-1">{{ __('common.start_date') }}</div>
                                        <div class="fw-bold text-gray-800">{{ $company->current_package->start_date->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <div class="fw-semibold text-gray-600 fs-7 mb-1">{{ __('common.end_date') }}</div>
                                        <div class="fw-bold text-gray-800">{{ $company->current_package->end_date->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <div class="fw-semibold text-gray-600 fs-7 mb-1">{{ __('common.status') }}</div>
                                        @if($company->current_package->isActive())
                                            <span class="badge badge-success fs-7">{{ __('client_packages.active') }}</span>
                                        @elseif($company->current_package->isExpired())
                                            <span class="badge badge-danger fs-7">{{ __('client_packages.expired') }}</span>
                                        @else
                                            <span class="badge badge-warning fs-7">{{ ucfirst($company->current_package->status) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            @if($company->current_package->package->description)
                            <div class="separator separator-dashed my-4"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="fw-semibold text-gray-600 fs-7 mb-2">{{ __('packages.description') }}:</div>
                                    <div class="text-gray-700 fs-6">{{ $company->current_package->package->description }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--end::Package Header Card-->

                    <!--begin::Package Limits & Usage-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('packages.usage_statistics') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!--begin::Employee Limit-->
                                <div class="col-md-4 mb-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-users text-primary fs-2x me-3"></i>
                                        <div>
                                            <div class="fw-bold text-gray-800 fs-5">{{ __('packages.max_employees') }}</div>
                                            <div class="fw-semibold text-gray-600 fs-7">
                                                {{ $packageStatus['employee_count'] ?? $company->employees()->count() }} / 
                                                {{ $company->current_package->package->max_employees ?? __('common.unlimited') }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($company->current_package->package->max_employees)
                                        <div class="progress h-8px bg-light-primary mb-2">
                                            @php
                                                $employeeCount = $packageStatus['employee_count'] ?? $company->employees()->count();
                                                $maxEmployees = $company->current_package->package->max_employees;
                                                $employeePercentage = $maxEmployees > 0 ? min(($employeeCount / $maxEmployees) * 100, 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $employeePercentage }}%;" aria-valuenow="{{ $employeePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between fs-8 text-gray-600">
                                            <span>{{ __('common.used') }}: {{ $employeeCount }}</span>
                                            <span>{{ __('common.remaining') }}: {{ max($maxEmployees - $employeeCount, 0) }}</span>
                                        </div>
                                    @else
                                        <div class="badge badge-light-success">{{ __('common.unlimited') }}</div>
                                    @endif
                                </div>
                                <!--end::Employee Limit-->

                                <!--begin::Employee Documents Limit-->
                                <div class="col-md-4 mb-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-file-alt text-info fs-2x me-3"></i>
                                        <div>
                                            <div class="fw-bold text-gray-800 fs-5">{{ __('packages.max_employee_documents') }}</div>
                                            <div class="fw-semibold text-gray-600 fs-7">
                                                {{ $packageStatus['employee_document_count'] ?? 0 }} / 
                                                {{ $company->current_package->package->max_employee_documents ?? __('common.unlimited') }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($company->current_package->package->max_employee_documents)
                                        <div class="progress h-8px bg-light-info mb-2">
                                            @php
                                                $empDocCount = $packageStatus['employee_document_count'] ?? 0;
                                                $maxEmpDocs = $company->current_package->package->max_employee_documents;
                                                $empDocPercentage = $maxEmpDocs > 0 ? min(($empDocCount / $maxEmpDocs) * 100, 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $empDocPercentage }}%;" aria-valuenow="{{ $empDocPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between fs-8 text-gray-600">
                                            <span>{{ __('common.used') }}: {{ $empDocCount }}</span>
                                            <span>{{ __('common.remaining') }}: {{ max($maxEmpDocs - $empDocCount, 0) }}</span>
                                        </div>
                                    @else
                                        <div class="badge badge-light-success">{{ __('common.unlimited') }}</div>
                                    @endif
                                </div>
                                <!--end::Employee Documents Limit-->

                                <!--begin::Company Documents Limit-->
                                <div class="col-md-4 mb-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-building text-warning fs-2x me-3"></i>
                                        <div>
                                            <div class="fw-bold text-gray-800 fs-5">{{ __('packages.max_company_documents') }}</div>
                                            <div class="fw-semibold text-gray-600 fs-7">
                                                {{ $packageStatus['company_document_count'] ?? 0 }} / 
                                                {{ $company->current_package->package->max_company_documents ?? __('common.unlimited') }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($company->current_package->package->max_company_documents)
                                        <div class="progress h-8px bg-light-warning mb-2">
                                            @php
                                                $compDocCount = $packageStatus['company_document_count'] ?? 0;
                                                $maxCompDocs = $company->current_package->package->max_company_documents;
                                                $compDocPercentage = $maxCompDocs > 0 ? min(($compDocCount / $maxCompDocs) * 100, 100) : 0;
                                            @endphp
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $compDocPercentage }}%;" aria-valuenow="{{ $compDocPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between fs-8 text-gray-600">
                                            <span>{{ __('common.used') }}: {{ $compDocCount }}</span>
                                            <span>{{ __('common.remaining') }}: {{ max($maxCompDocs - $compDocCount, 0) }}</span>
                                        </div>
                                    @else
                                        <div class="badge badge-light-success">{{ __('common.unlimited') }}</div>
                                    @endif
                                </div>
                                <!--end::Company Documents Limit-->
                            </div>
                        </div>
                    </div>
                    <!--end::Package Limits & Usage-->
                </div>
            </div>
            <!--end::Current Package Overview-->

            <!--begin::Package Actions-->
            <div class="d-flex flex-wrap gap-2">
                @can('renew_client_packages')
                    @if($company->current_package->isActive() || $company->current_package->isExpired())
                        <a href="{{ route('admin.companies.packages.renew', [$company, $company->current_package]) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-sync-alt fs-2"></i>{{ __('client_packages.renew') }}
                        </a>
                    @endif
                @endcan

                @can('assign_packages_to_clients')
                    <a href="{{ route('admin.companies.packages.change', [$company, $company->current_package]) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-exchange-alt fs-2"></i>{{ __('client_packages.change') }}
                    </a>
                @endcan

                @can('cancel_client_packages')
                    @if($company->current_package->isActive())
                        <form method="POST" action="{{ route('admin.companies.packages.cancel', [$company, $company->current_package]) }}" class="d-inline" onsubmit="return confirm('{{ __('client_packages.messages.package_canceled_successfully') }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-times fs-2"></i>{{ __('client_packages.cancel') }}
                            </button>
                        </form>
                    @endif
                @endcan
            </div>
            <!--end::Package Actions-->
        @else
            <!--begin::No Package-->
            <div class="text-center py-10">
                <div class="d-flex flex-column align-items-center">
                    <i class="fas fa-box-open fs-2x text-gray-400 mb-5"></i>
                    <div class="text-gray-600 fs-6 mb-5">{{ __('client_packages.messages.no_package_assigned') }}</div>
                    @can('assign_packages_to_clients')
                        <a href="{{ route('admin.companies.packages.assign', $company) }}" class="btn btn-primary">
                            <i class="fas fa-plus fs-2"></i>{{ __('client_packages.assign_package') }}
                        </a>
                    @endcan
                </div>
            </div>
            <!--end::No Package-->
        @endif
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
