@extends('admin.layouts.master')

@section('title', __('tasks.edit_task'))

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
                    {{ __('tasks.edit_task') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('tasks.tasks') }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('tasks.edit_task') }}</li>
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
            @if(auth()->user()->hasRole('employee'))
            <!--begin::Employee Notice-->
            <div class="alert alert-info d-flex align-items-center p-5 mb-10">
                <i class="fas fa-info-circle fs-2hx text-info me-4"></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-info">{{ __('tasks.employee_edit_notice_title') }}</h4>
                    <span>{{ __('tasks.employee_edit_notice_message') }}</span>
                </div>
            </div>
            <!--end::Employee Notice-->
            @endif

            @if(!auth()->user()->can('manage_task_documents'))
            <!--begin::Permission Notice-->
            <div class="alert alert-warning d-flex align-items-center p-5 mb-10">
                <i class="fas fa-exclamation-triangle fs-2hx text-warning me-4"></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-warning">{{ __('tasks.document_management_restricted_title') }}</h4>
                    <span>{{ __('tasks.document_management_restricted_message') }}</span>
                </div>
            </div>
            <!--end::Permission Notice-->
            @endif

            <!--begin::Form-->
            <form id="kt_task_edit_form" class="form" method="POST" action="{{ route('admin.tasks.update', $task) }}">
                @csrf
                @method('PUT')
                
                <!--begin::Card-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('tasks.task_details') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body border-0 p-9">
                        <!--begin::Row-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('tasks.title') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <input type="text" name="title" class="form-control form-control-lg form-control-solid @error('title') is-invalid @enderror" 
                                       placeholder="{{ __('tasks.enter_task_title') }}" value="{{ old('title', $task->title) }}"
                                       {{ auth()->user()->hasRole('employee') ? 'readonly' : '' }} />
                                @error('title')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('tasks.description') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <textarea name="description" class="form-control form-control-lg form-control-solid @error('description') is-invalid @enderror" 
                                          rows="3" placeholder="{{ __('tasks.enter_task_description') }}"
                                          {{ auth()->user()->hasRole('employee') ? 'readonly' : '' }}>{{ old('description', $task->description) }}</textarea>
                                @error('description')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->


                        <!--begin::Row-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('tasks.assigned_to') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <select name="assigned_to" class="form-select form-select-solid @error('assigned_to') is-invalid @enderror" 
                                        data-control="select2" data-placeholder="{{ __('tasks.select_assigned_user') }}">
                                    <option></option>
                                    <!-- Will be populated via AJAX -->
                                </select>
                                @error('assigned_to')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('tasks.status') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <select name="status" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                    @foreach($statuses as $key => $status)
                                        <option value="{{ $key }}" {{ old('status', $task->status) == $key ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        @if(!auth()->user()->hasRole('employee'))
                        <!--begin::Row-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('tasks.due_date') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <input type="date" name="due_date" class="form-control form-control-lg form-control-solid @error('due_date') is-invalid @enderror" 
                                       value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}" />
                                @error('due_date')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        @endif
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

                @if(auth()->user()->can('manage_task_documents'))
                <!--begin::Documents Card-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('tasks.current_documents') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body border-0 p-9">
                        <!--begin::Document Type Selection-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('tasks.document_type') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <select id="document_type_select" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="{{ __('tasks.select_document_type') }}">
                                    <option></option>
                                    @foreach($documentTypes as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Document Type Selection-->

                        <!--begin::Company Selection-->
                        <div class="row mb-6" id="company_selection_row" style="display: none;">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('tasks.client') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <select id="company_select" class="form-select form-select-solid" data-control="select2" data-placeholder="{{ __('tasks.select_client') }}">
                                    <option></option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->company_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Company Selection-->

                        <!--begin::Employee Selection (for employee documents)-->
                        <div class="row mb-6" id="employee_selection_row" style="display: none;">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('tasks.employee_selection') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <select id="employee_select" class="form-select form-select-solid" data-control="select2" data-placeholder="{{ __('tasks.select_employee_first') }}">
                                    <option></option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Employee Selection-->

                        <!--begin::Document Selection-->
                        <div class="row mb-6" id="document_selection_row" style="display: none;">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('tasks.document') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <select id="document_select" class="form-select form-select-solid" data-control="select2" data-placeholder="{{ __('tasks.select_company_first') }}">
                                    <option></option>
                                </select>
                                <div class="form-text">{{ __('tasks.select_document_type') }}</div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Document Selection-->

                        <!--begin::Add Document Button-->
                        <div class="row mb-6" id="add_document_row" style="display: none;">
                            <div class="col-lg-8 offset-lg-4">
                                <button type="button" id="add_document_btn" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('tasks.add_document') }}
                                </button>
                            </div>
                        </div>
                        <!--end::Add Document Button-->

                        <!--begin::Selected Documents-->
                        <div id="selected_documents_container" style="display: none;">
                            <div class="separator border-gray-200 mb-6"></div>
                            <h4 class="fw-bold mb-6">{{ __('tasks.selected_documents') }}</h4>
                            <div id="selected_documents_list">
                                <!-- Selected documents will be populated here -->
                            </div>
                        </div>
                        <!--end::Selected Documents-->

                        @error('documents')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Documents Card-->
                @endif

                <!--begin::Actions-->
                <div class="card">
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('admin.tasks.show', $task) }}" class="btn btn-light btn-active-light-primary me-2">{{ __('common.cancel') }}</a>
                        <button type="submit" class="btn btn-primary" id="kt_task_edit_submit">
                            <span class="indicator-label">{{ __('tasks.update_task') }}</span>
                            <span class="indicator-progress">{{ __('common.please_wait') }}...</span>
                        </button>
                    </div>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(!auth()->user()->hasRole('employee'))
    // Load employees for assignment
    loadEmployeesForAssignment();

    function loadEmployeesForAssignment() {
        fetch('{{ route("admin.tasks.ajax.employees-for-assignment") }}')
            .then(response => response.json())
            .then(employees => {
                const assignedToSelect = $('[name="assigned_to"]');
                assignedToSelect.empty().append('<option></option>');
                employees.forEach(employee => {
                    const selected = employee.id == {{ $task->assigned_to }} ? 'selected' : '';
                    assignedToSelect.append(`<option value="${employee.id}" ${selected}>${employee.name}</option>`);
                });
                assignedToSelect.trigger('change');
            })
            .catch(error => {
                console.error('Error loading employees:', error);
            });
    }
    @endif

    @if(auth()->user()->can('manage_task_documents'))
    const assignedToSelect = $('#assigned_to_select');
    const documentTypeSelect = $('#document_type_select');
    const companySelect = $('#company_select');
    const employeeSelect = $('#employee_select');
    const documentSelect = $('#document_select');
    const form = document.getElementById('kt_task_edit_form');
    
    let selectedDocuments = [];
    let availableEmployees = [];

    // Initialize with current task documents
    @if($task->taskDocuments->count() > 0)
        @foreach($task->taskDocuments as $taskDoc)
            selectedDocuments.push({
                id: {{ $taskDoc->document_id }},
                type: '{{ $taskDoc->document_type }}',
                name: '{{ $taskDoc->getDocumentTitle() }}',
                typeName: '{{ $taskDoc->isCompanyDocument() ? __("tasks.company_document") : __("tasks.employee_document") }}'
            });
        @endforeach
    @endif

    // Update UI with initial documents
    updateSelectedDocumentsUI();

    // Company selection change (in document selection area)
    companySelect.on('change', function() {
        const companyId = this.value;
        const documentType = documentTypeSelect.val();
        console.log('Company selected:', companyId, 'Document type:', documentType);
        
        // Reset dependent dropdowns
        employeeSelect.val(null).trigger('change');
        documentSelect.val(null).trigger('change');
        hideAddDocumentButton();
        
        if (companyId && documentType) {
            console.log('Loading data for company ID:', companyId, 'type:', documentType);
            if (documentType === 'company_document') {
                console.log('Loading company documents...');
                hideEmployeeSelection();
                showDocumentSelection();
                loadCompanyDocuments(companyId);
            } else if (documentType === 'employee_document') {
                console.log('Loading company employees...');
                showEmployeeSelection();
                hideDocumentSelection();
                loadCompanyEmployees(companyId);
            } else if (['civil_defense', 'municipality', 'branch_registration'].includes(documentType)) {
                console.log('Loading company licenses/registrations...');
                hideEmployeeSelection();
                showDocumentSelection();
                loadCompanyLicenses(companyId, documentType);
            }
        } else {
            console.log('Hiding selections - missing company or document type');
            hideEmployeeSelection();
            hideDocumentSelection();
        }
    });

    // Document type selection change
    documentTypeSelect.on('change', function() {
        const documentType = this.value;
        console.log('Document type selected:', documentType);
        
        // Reset dependent dropdowns
        companySelect.val(null).trigger('change');
        employeeSelect.val(null).trigger('change');
        documentSelect.val(null).trigger('change');

        if (documentType) {
            console.log('Showing company selection for document type:', documentType);
            showCompanySelection();
            if (['company_document', 'civil_defense', 'municipality', 'branch_registration'].includes(documentType)) {
                hideEmployeeSelection();
            } else if (documentType === 'employee_document') {
                // Employee selection will be shown after company is selected
                hideEmployeeSelection();
            }
            hideDocumentSelection();
        } else {
            console.log('No document type selected, hiding all sections');
            hideDocumentSelectionSections();
        }
    });

    // Employee selection change (for employee documents)
    employeeSelect.on('change', function() {
        const employeeId = this.value;
        
        if (employeeId) {
            showDocumentSelection();
            loadEmployeeDocuments(employeeId);
        } else {
            hideDocumentSelection();
        }
    });

    // Add document button
    document.getElementById('add_document_btn').addEventListener('click', function() {
        addSelectedDocument();
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        // Add selected documents to form as hidden inputs
        selectedDocuments.forEach((doc, index) => {
            const typeInput = document.createElement('input');
            typeInput.type = 'hidden';
            typeInput.name = `documents[${index}][type]`;
            typeInput.value = doc.type;
            form.appendChild(typeInput);

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = `documents[${index}][id]`;
            idInput.value = doc.id;
            form.appendChild(idInput);
        });
    });

    function loadCompanyEmployees(clientId) {
        console.log('Loading company employees for company ID:', clientId);
        fetch(`{{ route("admin.tasks.ajax.company-employees") }}?company_id=${clientId}`)
            .then(response => {
                console.log('Company employees response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(employees => {
                console.log('Company employees loaded:', employees);
                employeeSelect.empty().append('<option></option>');
                employees.forEach(employee => {
                    employeeSelect.append(new Option(employee.name, employee.id));
                });
                employeeSelect.trigger('change');
                availableEmployees = employees;
                
                if (employees.length === 0) {
                    console.warn('No employees found for this company');
                }
            })
            .catch(error => {
                console.error('Error loading company employees:', error);
                alert('Error loading employees: ' + error.message);
            });
    }

    function loadCompanyDocuments(clientId) {
        console.log('Loading company documents for company ID:', clientId);
        fetch(`{{ route("admin.tasks.ajax.company-documents") }}?company_id=${clientId}`)
            .then(response => {
                console.log('Company documents response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(documents => {
                console.log('Company documents loaded:', documents);
                documentSelect.empty().append('<option></option>');
                documents.forEach(doc => {
                    documentSelect.append(new Option(doc.name, doc.id));
                });
                documentSelect.trigger('change');
                
                if (documents.length > 0) {
                    showAddDocumentButton();
                } else {
                    console.warn('No documents found for this company');
                }
            })
            .catch(error => {
                console.error('Error loading company documents:', error);
                alert('Error loading documents: ' + error.message);
            });
    }

    function loadCompanyLicenses(companyId, documentType) {
        console.log('Loading company licenses for company ID:', companyId, 'type:', documentType);
        fetch(`{{ route("admin.tasks.ajax.company-licenses") }}?company_id=${companyId}&type=${documentType}`)
            .then(response => {
                console.log('Company licenses response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(documents => {
                console.log('Company licenses loaded:', documents);
                documentSelect.empty().append('<option></option>');
                documents.forEach(doc => {
                    documentSelect.append(new Option(doc.name, doc.id));
                });
                documentSelect.trigger('change');
                
                if (documents.length > 0) {
                    showAddDocumentButton();
                } else {
                    console.warn('No licenses found for this company');
                }
            })
            .catch(error => {
                console.error('Error loading company licenses:', error);
                alert('Error loading licenses: ' + error.message);
            });
    }

    function loadEmployeeDocuments(employeeId) {
        console.log('Loading employee documents for employee ID:', employeeId);
        fetch(`{{ route("admin.tasks.ajax.employee-documents") }}?employee_id=${employeeId}`)
            .then(response => {
                console.log('Employee documents response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(documents => {
                console.log('Employee documents loaded:', documents);
                documentSelect.empty().append('<option></option>');
                documents.forEach(doc => {
                    documentSelect.append(new Option(doc.name, doc.id));
                });
                documentSelect.trigger('change');
                
                if (documents.length > 0) {
                    showAddDocumentButton();
                } else {
                    console.warn('No documents found for this employee');
                }
            })
            .catch(error => {
                console.error('Error loading employee documents:', error);
                alert('Error loading employee documents: ' + error.message);
            });
    }

    function addSelectedDocument() {
        const documentId = documentSelect.val();
        const documentType = documentTypeSelect.val();
        
        if (!documentId || !documentType) {
            alert('{{ __("tasks.select_document") }}');
            return;
        }

        // Check if document already selected
        const exists = selectedDocuments.find(doc => 
            doc.id == documentId && doc.type === documentType
        );
        
        if (exists) {
            alert('{{ __("tasks.document_already_selected") }}');
            return;
        }

        // Get document name from select option
        const documentName = documentSelect.find('option:selected').text();
        
        // Add to selected documents
        selectedDocuments.push({
            id: documentId,
            type: documentType,
            name: documentName,
            typeName: documentTypeSelect.find('option:selected').text()
        });

        // Update UI
        updateSelectedDocumentsUI();
        
        // Reset document selection
        documentSelect.val(null).trigger('change');
    }

    function updateSelectedDocumentsUI() {
        const container = document.getElementById('selected_documents_container');
        const list = document.getElementById('selected_documents_list');
        
        if (selectedDocuments.length === 0) {
            container.style.display = 'none';
            return;
        }

        container.style.display = 'block';
        
        list.innerHTML = selectedDocuments.map((doc, index) => `
            <div class="d-flex align-items-center justify-content-between p-3 mb-3 border border-gray-300 rounded">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px me-3">
                        <div class="symbol-label bg-light-${doc.type === 'company_document' ? 'primary' : 'info'}">
                            <i class="fas fa-${doc.type === 'company_document' ? 'building' : 'user'} fs-4 text-${doc.type === 'company_document' ? 'primary' : 'info'}"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="fw-bold text-gray-800">${doc.name}</span>
                        <span class="text-muted fs-7">${doc.typeName}</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-light-danger" onclick="removeDocument(${index})">
                    <i class="fas fa-trash"></i> {{ __('tasks.remove_document') }}
                </button>
            </div>
        `).join('');
    }

    // Make removeDocument function global
    window.removeDocument = function(index) {
        selectedDocuments.splice(index, 1);
        updateSelectedDocumentsUI();
    }

    function showCompanySelection() {
        document.getElementById('company_selection_row').style.display = 'flex';
    }

    function hideCompanySelection() {
        document.getElementById('company_selection_row').style.display = 'none';
    }

    function showEmployeeSelection() {
        document.getElementById('employee_selection_row').style.display = 'flex';
    }

    function hideEmployeeSelection() {
        document.getElementById('employee_selection_row').style.display = 'none';
    }

    function showDocumentSelection() {
        document.getElementById('document_selection_row').style.display = 'flex';
    }

    function hideDocumentSelection() {
        document.getElementById('document_selection_row').style.display = 'none';
        hideAddDocumentButton();
    }

    function showAddDocumentButton() {
        document.getElementById('add_document_row').style.display = 'flex';
    }

    function hideAddDocumentButton() {
        document.getElementById('add_document_row').style.display = 'none';
    }

    function hideDocumentSelectionSections() {
        hideCompanySelection();
        hideEmployeeSelection();
        hideDocumentSelection();
        hideAddDocumentButton();
    }
    @endif
});
</script>
@endpush
