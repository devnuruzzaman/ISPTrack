<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\SubZoneController;
use App\Http\Controllers\Admin\BoxController;
use App\Http\Controllers\Admin\ClientTypeController;
use App\Http\Controllers\Admin\ConnectionTypeController;
use App\Http\Controllers\Admin\ProtocolTypeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\BillingStatusController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\SmsTemplateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Client\Auth\LoginController as ClientLoginController;
use App\Http\Controllers\Admin\SmsLogController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\BillingListController;
use App\Http\Controllers\Admin\BillingGatewayController;
use App\Http\Controllers\Admin\MikrotikServerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\SalarySheetController;
use App\Http\Controllers\Admin\SalaryPaymentController;
use App\Http\Controllers\Admin\PayrollReportController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\NetworkDeviceController;
use App\Http\Controllers\Admin\NetworkLinkController;
use App\Http\Controllers\Admin\LeaveRequestController;
use App\Http\Controllers\Admin\LeaveReportController;
use App\Http\Controllers\Admin\LeaveBalanceController;



// Default route redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard route (for global use)
Route::get('/dashboard', function () {
    // Redirect to admin dashboard if logged in as admin
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// Admin/Manager Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Client Authentication Routes
Route::get('client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
Route::post('client/login', [ClientLoginController::class, 'login'])->name('client.login.submit');
Route::post('client/logout', [ClientLoginController::class, 'logout'])->name('client.logout');

// Client Panel Routes
Route::middleware(['auth:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'clientDashboard'])->name('dashboard');
    Route::get('invoices', [InvoiceController::class, 'clientInvoices'])->name('invoices');
    Route::get('payments', [PaymentController::class, 'clientPayments'])->name('payments');
    Route::get('support', [SmsController::class, 'clientSupport'])->name('support');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Client Management
    Route::resource('clients', ClientController::class);
    Route::get('clients/left', [ClientController::class, 'leftClients'])->name('clients.left');
    Route::get('clients/requests', [ClientController::class, 'newRequests'])->name('clients.requests');
    Route::post('clients/{client}/suspend', [ClientController::class, 'suspend'])->name('clients.suspend');
    Route::post('clients/{client}/activate', [ClientController::class, 'activate'])->name('clients.activate');

    // Admin Configuration Routes
    Route::prefix('configuration')->name('configuration.')->group(function () {
        Route::resource('zones', ZoneController::class);
        Route::resource('sub-zones', SubZoneController::class);
        Route::resource('boxes', BoxController::class);
        Route::resource('devices', DeviceController::class);
        Route::resource('connection-types', ConnectionTypeController::class);
        Route::resource('client-types', ClientTypeController::class);
        Route::resource('protocol-types', ProtocolTypeController::class);
        Route::resource('billing-statuses', BillingStatusController::class);
        Route::resource('packages', PackageController::class);
        Route::resource('districts', DistrictController::class);
        Route::resource('upazilas', UpazilaController::class);
        Route::resource('payment-methods', PaymentMethodController::class);
    });

    // Billing List (CRUD)
    Route::prefix('billings')->name('billings.')->group(function () {
        Route::get('/', [BillingController::class, 'index'])->name('index');
        Route::get('create', [BillingController::class, 'create'])->name('create');
        Route::post('store', [BillingController::class, 'store'])->name('store');
        Route::get('{id}/edit', [BillingController::class, 'edit'])->name('edit');
        Route::put('{id}', [BillingController::class, 'update'])->name('update');
        Route::delete('{id}', [BillingController::class, 'destroy'])->name('destroy');
        Route::get('{id}', [BillingController::class, 'show'])->name('show');

        // Payment Gateway Info
        Route::get('bkash', [BillingController::class, 'bkash'])->name('bkash');
        Route::post('bkash', [BillingController::class, 'bkashUpdate'])->name('bkash.update');
        Route::get('nagad', [BillingController::class, 'nagad'])->name('nagad');
        Route::post('nagad', [BillingController::class, 'nagadUpdate'])->name('nagad.update');
        Route::get('rocket', [BillingController::class, 'rocket'])->name('rocket');
        Route::post('rocket', [BillingController::class, 'rocketUpdate'])->name('rocket.update');
        Route::get('manual', [BillingController::class, 'manual'])->name('manual');
        Route::post('manual', [BillingController::class, 'manualUpdate'])->name('manual.update');
        Route::get('online', [BillingController::class, 'online'])->name('online');
        Route::post('online', [BillingController::class, 'onlineUpdate'])->name('online.update');
    });

    // Payment & Invoice
    Route::resource('payments', PaymentController::class);
    Route::post('payments/{payment}/approve', [PaymentController::class, 'approve'])->name('payments.approve');
    Route::post('payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');

    Route::resource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/generate', [InvoiceController::class, 'generate'])->name('invoices.generate');
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');

    // SMS
    Route::resource('sms', SmsController::class);
    Route::resource('sms-templates', SmsTemplateController::class);
    Route::post('sms/send', [SmsController::class, 'send'])->name('sms.send');
    Route::get('sms/logs', [SmsLogController::class, 'index'])->name('sms.logs');

    // Reports
    Route::get('reports/clients', [DashboardController::class, 'clientReport'])->name('reports.clients');
    Route::get('reports/payments', [DashboardController::class, 'paymentReport'])->name('reports.payments');
    Route::get('reports/invoices', [DashboardController::class, 'invoiceReport'])->name('reports.invoices');
    Route::get('reports/bandwidth', [DashboardController::class, 'bandwidthReport'])->name('reports.bandwidth');

    // HR & Payroll Module Routes (Admin)
    Route::prefix('hr')->name('hr.')->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('attendance', AttendanceController::class);
        Route::resource('salary_sheet', SalarySheetController::class); // সম্পূর্ণ CRUD
        Route::resource('salary_payment', SalaryPaymentController::class)->only(['index', 'store']);
        Route::resource('payroll_report', PayrollReportController::class)->only(['index']);
        Route::resource('departments', DepartmentController::class);
        Route::resource('designations', DesignationController::class);
        Route::resource('leave_types', LeaveTypeController::class);
    });

    // Network Device & Link Resource Routes
    Route::resource('network-devices', NetworkDeviceController::class);
    Route::resource('network-links', NetworkLinkController::class);

    // Network Topology View & Map Upload
    Route::get('network-topology', [NetworkDeviceController::class, 'topologyView'])->name('network-topology');
    Route::post('network-topology/upload-map', [NetworkDeviceController::class, 'uploadMap'])->name('network-topology.upload-map');
});

// Other Roles
Route::middleware(['auth', 'role:billing_manager'])->prefix('billing')->name('billing.')->group(function () {
    Route::get('dashboard', [BillingController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:technical_manager'])->prefix('technical')->name('technical.')->group(function () {
    //Route::get('dashboard', [TechnicalController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:client_manager'])->prefix('client-manager')->name('client_manager.')->group(function () {
    //Route::get('dashboard', [ClientManagerController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:report_viewer'])->prefix('report')->name('report.')->group(function () {
    //Route::get('dashboard', [ReportController::class, 'index'])->name('dashboard');
});

// Mikrotik Management Routes
Route::prefix('admin/mikrotik')->name('admin.mikrotik.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('servers', [MikrotikServerController::class, 'index'])->name('servers.index');
    Route::get('servers/create', [MikrotikServerController::class, 'create'])->name('servers.create');
    Route::post('servers', [MikrotikServerController::class, 'store'])->name('servers.store');
    Route::get('servers/{id}/edit', [MikrotikServerController::class, 'edit'])->name('servers.edit');
    Route::put('servers/{id}', [MikrotikServerController::class, 'update'])->name('servers.update');
    Route::delete('servers/{id}', [MikrotikServerController::class, 'destroy'])->name('servers.destroy');

    Route::get('import', [MikrotikServerController::class, 'importForm'])->name('import.form');
    Route::post('import', [MikrotikServerController::class, 'importFromMikrotik'])->name('import.mikrotik');

    Route::get('bulk-import', [MikrotikServerController::class, 'bulkImportForm'])->name('bulk.import.form');
    Route::post('bulk-import', [MikrotikServerController::class, 'bulkImportStore'])->name('bulk.import.store');
    Route::get('backups', [MikrotikServerController::class, 'backupIndex'])->name('backups.index');
    Route::get('backups/create', [MikrotikServerController::class, 'backupCreate'])->name('backups.create');
    Route::post('backups', [MikrotikServerController::class, 'backupStore'])->name('backups.store');
});

// Leave Management Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin/LeaveManagement')->name('admin.LeaveManagement.')->group(function () {

    // Leave Requests
    Route::resource('leave_requests', LeaveRequestController::class)->only(['index', 'create', 'store']);
    Route::post('leave_requests/{id}/approve', [LeaveRequestController::class, 'approve'])->name('leave_requests.approve');
    Route::post('leave_requests/{id}/reject', [LeaveRequestController::class, 'reject'])->name('leave_requests.reject');

    // Leave Reports
    Route::get('leave_reports', [LeaveReportController::class, 'index'])->name('leave_reports.index');

    // Leave Balance
    Route::get('leave_balance', [LeaveBalanceController::class, 'index'])->name('leave_balance.index');

    // Leave Type Setup
    Route::resource('leave_types', LeaveTypeController::class);
});
