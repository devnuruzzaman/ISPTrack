<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\SmsLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function index()
    {
        try {
            $data = [
                'totalClients'   => Client::count(),
                'activeClients'  => Client::where('is_active', true)->count(),
                'todaySmsSent'   => SmsLog::whereDate('created_at', Carbon::today())->count(),
                'monthlySmsSent' => SmsLog::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count(),
                'duePayments'    => Invoice::where('status', 'unpaid')
                    ->where('due_date', '<', Carbon::now())
                    ->sum('amount'),
            ];

            // Monthly revenue chart data
            $monthlyRevenue = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();

            // Fill missing months with 0
            $chartData = [];
            for ($i = 1; $i <= 12; $i++) {
                $chartData[$i] = $monthlyRevenue[$i] ?? 0;
            }

            $data['chartData'] = $chartData;

            return view('admin.dashboard', compact('data'));
        } catch (\Exception $e) {
            Log::error('DashboardController@index error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()->with('error', 'ড্যাশবোর্ড লোড করতে সমস্যা হয়েছে: ' . $e->getMessage());
        }
    }

    /**
     * Client Dashboard
     */
    public function clientDashboard()
    {
        try {
            $user = auth()->user();

            $invoices = Invoice::where('client_id', $user->id)->latest()->take(5)->get();
            $payments = Payment::where('client_id', $user->id)->latest()->take(5)->get();

            return view('client.dashboard', compact('invoices', 'payments'));
        } catch (\Exception $e) {
            Log::error('DashboardController@clientDashboard error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()->with('error', 'ক্লায়েন্ট ড্যাশবোর্ড লোড করতে সমস্যা হয়েছে: ' . $e->getMessage());
        }
    }
}
