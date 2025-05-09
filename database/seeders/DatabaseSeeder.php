<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Client;
use App\Models\User;
use App\Models\ClientType;
use App\Models\ConnectionType;
use App\Models\ProtocolType;
use App\Models\Box;
use App\Models\Zone;
use App\Models\SubZone;
use App\Models\District;
use App\Models\Upazila;
use App\Models\BillingStatus;
use App\Models\PaymentMethod;
use App\Models\Device;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $adminRole = Role::create(['name' => 'admin']);
        $billingManagerRole = Role::create(['name' => 'billing_manager']);
        $technicalManagerRole = Role::create(['name' => 'technical_manager']);
        $clientManagerRole = Role::create(['name' => 'client_manager']);
        $reportViewerRole = Role::create(['name' => 'report_viewer']);

        // Permissions
        $permissions = [
            'view_dashboard',
            'manage_clients',
            'manage_packages',
            'manage_billing',
            'manage_payments',
            'manage_zones',
            'manage_devices',
            'view_reports',
            'manage_settings'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole->givePermissionTo(Permission::all());

        // Admin user
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('admin');

        // Static data
        $clientType = ClientType::create([
            'name' => 'Home',
            'code' => 'HOME',
            'description' => 'Home internet connection',
            'is_active' => true
        ]);

        $connectionType = ConnectionType::create([
            'name' => 'Fiber',
            'code' => 'FIBER',
            'description' => 'Fiber optic connection',
            'discount_percentage' => 0,
            'is_active' => true
        ]);

        $protocolType = ProtocolType::create([
            'name' => 'PPPoE',
            'code' => 'PPPOE',
            'description' => 'Point-to-Point Protocol over Ethernet',
            'is_active' => true
        ]);

        $district = District::create([
            'name' => 'Dhaka',
            'code' => 'DHK',
            'is_active' => true
        ]);

        $upazila = Upazila::create([
            'district_id' => $district->id,
            'name' => 'Uttara',
            'code' => 'UTT',
            'is_active' => true
        ]);

        $billingStatus = BillingStatus::create([
            'name' => 'Paid',
            'code' => 'PAID',
            'description' => 'Payment completed',
            'is_active' => true
        ]);

        $paymentMethod = PaymentMethod::create([
            'name' => 'Cash',
            'code' => 'CASH',
            'description' => 'Cash payment',
            'is_active' => true
        ]);

        $zone = Zone::create([
            'name' => 'Banani',
            'code' => 'BANANI',
            'description' => 'Banani area',
            'is_active' => true
        ]);

        $subZone = SubZone::create([
            'zone_id' => $zone->id,
            'name' => 'Banani Block A',
            'code' => 'BANANI-A',
            'description' => 'Banani Block A area',
            'is_active' => true
        ]);

        $box = Box::create([
            'sub_zone_id' => $subZone->id,
            'name' => 'Box-001',
            'code' => 'BOX-001',
            'location' => 'Banani Signal',
            'capacity' => 100,
            'description' => 'Main distribution box',
            'is_active' => true
        ]);

        $device = Device::create([
            'box_id' => $box->id,
            'name' => 'Router',
            'model' => 'Mikrotik hAP ac2',
            'serial_number' => 'MTK123456',
            'mac_address' => '00:11:22:33:44:55',
            'ip_address' => '192.168.1.1',
            'type' => 'router',
            'specifications' => 'Dual-band, 5 ports, 2.4GHz/5GHz',
            'description' => 'Main distribution router',
            'is_active' => true
        ]);

        $package = Package::create([
            'name' => '10 Mbps Home Package',
            'code' => 'HOME-10',
            'speed' => 10.00,
            'speed_unit' => 'Mbps',
            'price' => 800.00,
            'setup_fee' => 1000.00,
            'features' => "24/7 Support\nUnlimited Data\nFree Installation",
            'description' => 'Basic home internet package',
            'is_public' => true,
            'is_active' => true
        ]);

        // Clients
        Client::create([
            'user_id' => $user->id,
            'client_type_id' => $clientType->id,
            'connection_type_id' => $connectionType->id,
            'protocol_type_id' => $protocolType->id,
            'box_id' => $box->id,
            'package_id' => $package->id,
            'client_id' => 'CL001',
            'connection_id' => 'CN001',
            'name' => 'Abdur Rahim',
            'phone' => '01812345678',
            'email' => 'rahim@example.com',
            'address' => 'Flat 5A, House 45, Road 8, Dhanmondi, Dhaka',
            'installation_address' => 'Flat 5A, House 45, Road 8, Dhanmondi, Dhaka',
            'monthly_bill' => 800.00,
            'setup_fee' => 1000.00,
            'billing_cycle' => 1,
            'due_date' => now(),
            'connection_date' => now(),
            'status' => 'active',
            'is_active' => true,
            'notes' => 'Demo client',
            'password' => bcrypt('password')
        ]);
    }
}
