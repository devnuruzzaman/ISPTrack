<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Create application roles and permissions
     */
    private function createRolesAndPermissions(): void
    {
        // Create roles
        $roles = [
            'admin' => 'Full access to all features',
            'billing_manager' => 'Manage billing and payments',
            'technical_manager' => 'Manage technical configurations',
            'client_manager' => 'Manage clients and support',
            'report_viewer' => 'View reports only',
        ];

        foreach ($roles as $roleName => $description) {
            Role::firstOrCreate(['name' => $roleName], ['guard_name' => 'web', 'description' => $description]);
        }

        // Create permissions
        $permissions = [
            'admin.access' => 'Full admin access',
            'admin.dashboard.view' => 'View admin dashboard',

            'client.view' => 'View clients',
            'client.create' => 'Create clients',
            'client.edit' => 'Edit clients',
            'client.delete' => 'Delete clients',
            'client.suspend' => 'Suspend clients',
            'client.activate' => 'Activate clients',

            'billing.view' => 'View billing',
            'billing.generate' => 'Generate invoices',
            'billing.view_invoices' => 'View invoices',
            'billing.view_payments' => 'View payments',
            'billing.approve_payment' => 'Approve payments',
            'billing.reject_payment' => 'Reject payments',

            'config.view' => 'View configurations',
            'config.edit' => 'Edit configurations',
            'config.create' => 'Create configurations',
            'config.delete' => 'Delete configurations',

            'support.view' => 'View support tickets',
            'support.create' => 'Create support tickets',
            'support.reply' => 'Reply to support tickets',
            'support.close' => 'Close support tickets',

            'report.view' => 'View reports',
            'report.generate' => 'Generate reports',
        ];

        foreach ($permissions as $permissionName => $description) {
            Permission::firstOrCreate(['name' => $permissionName], ['guard_name' => 'web', 'description' => $description]);
        }

        // Assign permissions to roles
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        $billingManager = Role::findByName('billing_manager');
        $billingManager->givePermissionTo([
            'billing.view',
            'billing.generate',
            'billing.view_invoices',
            'billing.view_payments',
            'billing.approve_payment',
            'billing.reject_payment',
            'report.view',
            'report.generate',
        ]);

        $technicalManager = Role::findByName('technical_manager');
        $technicalManager->givePermissionTo([
            'config.view',
            'config.edit',
            'config.create',
            'config.delete',
            'report.view',
            'report.generate',
        ]);

        $clientManager = Role::findByName('client_manager');
        $clientManager->givePermissionTo([
            'client.view',
            'client.create',
            'client.edit',
            'client.delete',
            'client.suspend',
            'client.activate',
            'support.view',
            'support.create',
            'support.reply',
            'support.close',
            'report.view',
            'report.generate',
        ]);

        $reportViewer = Role::findByName('report_viewer');
        $reportViewer->givePermissionTo([
            'report.view',
            'report.generate',
        ]);
    }
}
