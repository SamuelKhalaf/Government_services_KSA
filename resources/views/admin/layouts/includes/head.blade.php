<head><base href=""/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @php
        $currentLang = app()->getLocale();
        $isRTL = $currentLang === 'ar';
    @endphp
    <meta property="og:locale" content="{{ $currentLang === 'ar' ? 'ar_SA' : 'en_US' }}" />
    <title>@yield('title') - @lang('app.app_name')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if($isRTL)
        <meta name="direction" content="rtl" />
    @endif
    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    @if($isRTL)
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @endif
    <!--end::Fonts-->
    <!--begin::FontAwesome Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--end::FontAwesome Icons-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    @if($isRTL)
        <!--begin::Arabic RTL Support-->
        <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Arabic RTL Support-->
    @else
        <!--begin::English Support-->
        <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::English Support-->
    @endif
    <!--end::Global Stylesheets Bundle-->

    @if($isRTL)
        <!--begin::Arabic RTL Styles-->
        <style>
            /* Arabic Font Override */
            body, .menu-title, .page-heading, .breadcrumb-item, .form-control, .form-select, .btn {
                font-family: 'Noto Sans Arabic', 'Inter', sans-serif !important;
            }

            /* Menu Adjustments */
            .menu-arrow {
                transform: rotate(180deg);
            }

            /* Table Headers RTL */
            .table th, .table td {
                text-align: right !important;
                direction: rtl !important;
            }

            /* DataTable Headers */
            .dataTables_wrapper .table thead th {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Table Actions Column - Keep Left for Icons */
            .table th:last-child,
            .table td:last-child {
                text-align: left !important;
                direction: ltr !important;
            }

            /* Card Titles and Headers */
            .card-title, .card-header, .page-heading {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Form Labels */
            .form-label, label {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Breadcrumb */
            .breadcrumb {
                direction: rtl !important;
            }
            .breadcrumb-item + .breadcrumb-item::before {
                float: left !important;
                margin-right: 0.5rem !important;
                margin-left: 0 !important;
            }

            /* Buttons in RTL */
            .btn-group {
                direction: rtl !important;
            }

            /* DataTable Search and Info */
            .dataTables_filter, .dataTables_info {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Pagination */
            .dataTables_paginate {
                direction: ltr !important; /* Keep pagination LTR for consistency */
            }

            /* Modal Content */
            .modal-header, .modal-body, .modal-footer {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Modal Close Button - Keep Right Side */
            .modal-header .btn-close,
            .modal-header [data-kt-users-modal-action="close"] {
                margin-left: 0 !important;
                margin-right: auto !important;
            }

            /* Form Rows in Modal */
            .modal .row .col-md-6 {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Sidebar Menu */
            .app-sidebar .menu-item {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Header User Menu */
            .app-navbar .menu {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Notification and Language Dropdown */
            .menu-sub .menu-item {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Content Areas */
            .app-content {
                direction: rtl !important;
            }

            /* Card Body */
            .card-body {
                direction: rtl !important;
            }

            /* Toolbar */
            .card-toolbar {
                direction: rtl !important;
            }

            /* Search Input */
            .form-control[data-kt-user-table-filter="search"] {
                text-align: right !important;
                direction: rtl !important;
            }

            /* Status Badges - Keep Center Aligned */
            .badge {
                direction: ltr !important;
            }

            /* Additional DataTable RTL Fixes */
            .dataTables_wrapper .dataTables_length {
                direction: rtl !important;
                text-align: right !important;
            }

            .dataTables_wrapper .dataTables_length select {
                margin-left: 0.5rem !important;
                margin-right: 0 !important;
            }

            /* Table Sort Icons - Keep Right Side for RTL */
            .table th.sorting:after,
            .table th.sorting_asc:after,
            .table th.sorting_desc:after {
                right: auto !important;
                left: 8px !important;
            }

            /* Action Buttons in Table */
            .table td .btn-group {
                direction: ltr !important;
            }

            /* Form Group RTL */
            .fv-row {
                direction: rtl !important;
                text-align: right !important;
            }

            /* Input Groups */
            .input-group {
                direction: rtl !important;
            }

            /* Dropdown Menus */
            .dropdown-menu {
                direction: rtl !important;
                text-align: right !important;
            }

            /* Toast/Alert Messages */
            .alert {
                direction: rtl !important;
                text-align: right !important;
            }

            /* Sidebar Toggle */
            .app-sidebar-toggle {
                left: auto !important;
                right: -15px !important;
            }

            /* RTL Body and Root Elements */
            body.app-rtl {
                direction: rtl !important;
            }

            /* Header Menu Adjustments */
            .app-header .menu-item {
                direction: rtl !important;
            }

            /* Language Switcher in Header */
            .app-navbar .menu-sub .menu-item .menu-link {
                direction: rtl !important;
                text-align: right !important;
            }

            /* Page Title and Toolbar */
            .page-title {
                direction: rtl !important;
                text-align: right !important;
            }

            /* Content Container */
            .app-container {
                direction: rtl !important;
            }

            /* Fix for Select2 Dropdown in RTL */
            .select2-container--bootstrap5 .select2-dropdown {
                direction: rtl !important;
            }
        </style>
        <!--end::Arabic RTL Styles-->
    @endif

</head>
