<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Admin Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="{{ asset('adminlte/img/AdminLTELogo.png')}}" alt="Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Configuration -->
                    <li class="nav-item has-treeview {{ request()->is('admin/configuration*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/configuration*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Configuration
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.zones.index') }}" class="nav-link {{ request()->routeIs('admin.zones.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Zone</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.sub-zones.index') }}" class="nav-link {{ request()->routeIs('admin.sub-zones.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Zone</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.boxes.index') }}" class="nav-link {{ request()->routeIs('admin.boxes.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Box</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.devices.index') }}" class="nav-link {{ request()->routeIs('admin.devices.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Device</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.connection-types.index') }}" class="nav-link {{ request()->routeIs('admin.connection-types.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Connection Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.client-types.index') }}" class="nav-link {{ request()->routeIs('admin.client-types.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Client Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.protocol-types.index') }}" class="nav-link {{ request()->routeIs('admin.protocol-types.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Protocol Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.billing-statuses.index') }}" class="nav-link {{ request()->routeIs('admin.billing-statuses.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Billing Status</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Package</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.districts.index') }}" class="nav-link {{ request()->routeIs('admin.districts.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>District</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.upazilas.index') }}" class="nav-link {{ request()->routeIs('admin.upazilas.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Upazila</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.configuration.payment-methods.index') }}" class="nav-link {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payment Method</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Client Management -->
                    <li class="nav-item has-treeview {{ request()->is('admin/clients*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/clients*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Client Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.index') ? 'active' : '' }}">
                                    <i class="fas fa-cogs nav-icon"></i>
                                    <p>Manage</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.clients.create') }}" class="nav-link {{ request()->routeIs('admin.clients.create') ? 'active' : '' }}">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.index') ? 'active' : '' }}">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Client List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.clients.left') }}" class="nav-link {{ request()->routeIs('admin.clients.left') ? 'active' : '' }}">
                                    <i class="fas fa-user-times nav-icon"></i>
                                    <p>Left Client</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.clients.requests') }}" class="nav-link {{ request()->routeIs('admin.clients.requests') ? 'active' : '' }}">
                                    <i class="fas fa-user-clock nav-icon"></i>
                                    <p>New Request</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Billing -->
                    <li class="nav-item has-treeview {{ request()->is('admin/billings*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/billings*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>
                                Billing
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.billings.index') }}" class="nav-link {{ request()->routeIs('admin.billings.index') ? 'active' : '' }}">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Billing List</p>
                                </a>
                            </li>
                            <!-- Payment Gateway Info -->
                            <li class="nav-item has-treeview {{ request()->is('admin/billing/*') ? 'menu-open' : '' }}">
                                <a href="{{ route('admin.billings.index') }}" class="nav-link {{ request()->is('admin/billing/*') ? 'active' : '' }}">
                                    <i class="fas fa-university nav-icon"></i>
                                    <p>
                                        Payment Gateway Info
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.billings.bkash') }}" class="nav-link {{ request()->routeIs('admin.billings.bkash') ? 'active' : '' }}">
                                            <img src="{{ asset('images/bkash.png') }}" alt="Bkash Logo" style="height:20px;width:auto;margin-right:8px;">
                                            <p>Bkash</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.billings.nagad') }}" class="nav-link {{ request()->routeIs('admin.billings.nagad') ? 'active' : '' }}">
                                            <img src="{{ asset('images/nagad.png') }}" alt="Nagad Logo" style="height:20px;width:auto;margin-right:8px;">
                                            <p>Nagad</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.billings.rocket') }}" class="nav-link {{ request()->routeIs('admin.billings.rocket') ? 'active' : '' }}">
                                            <img src="{{ asset('images/rocket.png') }}" alt="Rocket Logo" style="height:20px;width:auto;margin-right:8px;">
                                            <p>Rocket</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.billings.manual') }}" class="nav-link {{ request()->routeIs('admin.billings.manual') ? 'active' : '' }}">
                                            <i class="fas fa-hand-holding-usd nav-icon"></i>
                                            <p>Manual Gateway</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.billings.online') }}" class="nav-link {{ request()->routeIs('admin.billings.online') ? 'active' : '' }}">
                                            <i class="fas fa-globe nav-icon"></i>
                                            <p>Online Payment Setup</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Mikrotik Management -->
                    <li class="nav-item has-treeview {{ request()->is('admin/mikrotik*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/mikrotik*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-network-wired"></i>
                            <p>
                                Mikrotik Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.mikrotik.servers.index') }}" class="nav-link {{ request()->routeIs('admin.mikrotik.servers.index') ? 'active' : '' }}">
                                    <i class="fas fa-server nav-icon"></i>
                                    <p>Servers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.mikrotik.import.form') }}" class="nav-link {{ request()->routeIs('admin.mikrotik.import.form') ? 'active' : '' }}">
                                    <i class="fas fa-download nav-icon"></i>
                                    <p>Import From Mikrotik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.mikrotik.bulk.import.form') }}" class="nav-link {{ request()->routeIs('admin.mikrotik.bulk.import.form') ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Bulk Clients Import</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.mikrotik.backups.index') }}" class="nav-link {{ request()->routeIs('admin.mikrotik.backups.index') ? 'active' : '' }}">
                                    <i class="fas fa-hdd nav-icon"></i>
                                    <p>Server Backups</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- HR & Payroll -->
                    <li class="nav-item has-treeview {{ request()->is('admin/hr*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/hr*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                HR & Payroll
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.employees.index') }}" class="nav-link {{ request()->routeIs('admin.hr.employees.index') ? 'active' : '' }}">
                                    <i class="fas fa-user nav-icon"></i>
                                    <p>Employee List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.employees.create') }}" class="nav-link {{ request()->routeIs('admin.hr.employees.create') ? 'active' : '' }}">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Add New Employee</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.attendance.index') }}" class="nav-link {{ request()->routeIs('admin.hr.attendance.index') ? 'active' : '' }}">
                                    <i class="fas fa-calendar-check nav-icon"></i>
                                    <p>Attendance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.salary_sheet.index') }}" class="nav-link {{ request()->routeIs('admin.hr.salary_sheet.index') ? 'active' : '' }}">
                                    <i class="fas fa-money-check-alt nav-icon"></i>
                                    <p>Salary Sheet</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.salary_payment.index') }}" class="nav-link {{ request()->routeIs('admin.hr.salary_payment.index') ? 'active' : '' }}">
                                    <i class="fas fa-hand-holding-usd nav-icon"></i>
                                    <p>Salary Payment</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.payroll_report.index') }}" class="nav-link {{ request()->routeIs('admin.hr.payroll_report.index') ? 'active' : '' }}">
                                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                    <p>Payroll Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.departments.index') }}" class="nav-link {{ request()->routeIs('admin.hr.departments.index') ? 'active' : '' }}">
                                    <i class="fas fa-building nav-icon"></i>
                                    <p>Department Setup</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.designations.index') }}" class="nav-link {{ request()->routeIs('admin.hr.designations.index') ? 'active' : '' }}">
                                    <i class="fas fa-briefcase nav-icon"></i>
                                    <p>Designation Setup</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hr.leave_types.index') }}" class="nav-link {{ request()->routeIs('admin.hr.leave_types.index') ? 'active' : '' }}">
                                    <i class="fas fa-calendar-alt nav-icon"></i>
                                    <p>Leave Type Setup</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Network Diagram -->
                    <li class="nav-item has-treeview {{ request()->is('admin/network-*') || request()->routeIs('admin.network-topology') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/network-*') || request()->routeIs('admin.network-topology') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                Network Diagram
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.network-devices.index') }}" class="nav-link {{ request()->routeIs('admin.network-devices.*') ? 'active' : '' }}">
                                    <i class="fas fa-server nav-icon"></i>
                                    <p>Network Devices</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.network-links.index') }}" class="nav-link {{ request()->routeIs('admin.network-links.*') ? 'active' : '' }}">
                                    <i class="fas fa-link nav-icon"></i>
                                    <p>Network Links</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.network-topology') }}" class="nav-link {{ request()->routeIs('admin.network-topology') ? 'active' : '' }}">
                                    <i class="fas fa-sitemap nav-icon"></i>
                                    <p>Topology View</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Leave Management -->
                        <li class="nav-item has-treeview {{ request()->is('admin/LeaveManagement/*') || request()->routeIs('admin.LeaveManagement.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/LeaveManagement/*') || request()->routeIs('admin.LeaveManagement.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-plane-departure"></i>
                                <p>
                                    Leave Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.LeaveManagement.leave_requests.create') }}" class="nav-link {{ request()->routeIs('admin.LeaveManagement.leave_requests.create') ? 'active' : '' }}">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Leave Request</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.LeaveManagement.leave_requests.index') }}" class="nav-link {{ request()->routeIs('admin.LeaveManagement.leave_requests.index') ? 'active' : '' }}">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Approve/Reject Leave</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.LeaveManagement.leave_reports.index') }}" class="nav-link {{ request()->routeIs('admin.LeaveManagement.leave_reports.index') ? 'active' : '' }}">
                                        <i class="fas fa-chart-bar nav-icon"></i>
                                        <p>Leave Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.LeaveManagement.leave_balance.index') }}" class="nav-link {{ request()->routeIs('admin.LeaveManagement.leave_balance.index') ? 'active' : '' }}">
                                        <i class="fas fa-balance-scale nav-icon"></i>
                                        <p>Leave Balance</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.LeaveManagement.leave_types.index') }}" class="nav-link {{ request()->routeIs('admin.LeaveManagement.leave_types.index') ? 'active' : '' }}">
                                        <i class="fas fa-cogs nav-icon"></i>
                                        <p>Leave Type Setup</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    <!-- SMS Management -->
                    <li class="nav-item {{ request()->routeIs('admin.sms.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.sms.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-sms"></i>
                            <p>
                                SMS Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.sms-templates.index') }}" class="nav-link {{ request()->routeIs('admin.sms.templates.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SMS Templates</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sms.send') }}" class="nav-link {{ request()->routeIs('admin.sms.send') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Send SMS</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sms.logs') }}" class="nav-link {{ request()->routeIs('admin.sms.logs') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SMS Logs</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block"><b>Version</b> 1.0.0</div>
        <strong>&copy; {{ date('Y') }} <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>.</strong> All rights reserved.
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

@stack('scripts')
</body>
</html>
