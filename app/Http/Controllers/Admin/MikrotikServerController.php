<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MikrotikServer;
use RouterOS\Client;

class MikrotikServerController extends Controller
{
    // Server List
    public function index()
    {
        $servers = MikrotikServer::all();
        return view('admin.mikrotik.servers.index', compact('servers'));
    }

    // Show Create Form
    public function create()
    {
        return view('admin.mikrotik.servers.create');
    }

    // Store New Server
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ip' => 'required|ip',
            'api_port' => 'required|integer',
            'username' => 'required',
            'password' => 'required',
        ]);
        MikrotikServer::create($request->all());
        return redirect()->route('admin.mikrotik.servers.index')->with('success', 'Server added!');
    }

    // Show Edit Form
    public function edit($id)
    {
        $server = MikrotikServer::findOrFail($id);
        return view('admin.mikrotik.servers.edit', compact('server'));
    }

    // Update Server
    public function update(Request $request, $id)
    {
        $server = MikrotikServer::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'ip' => 'required|ip',
            'api_port' => 'required|integer',
            'username' => 'required',
            'password' => 'required',
        ]);
        $server->update($request->all());
        return redirect()->route('admin.mikrotik.servers.index')->with('success', 'Server updated!');
    }

    // Delete Server
    public function destroy($id)
    {
        $server = MikrotikServer::findOrFail($id);
        $server->delete();
        return redirect()->route('admin.mikrotik.servers.index')->with('success', 'Server deleted!');
    }

    // Import Form From Mikrotik
    public function importForm()
    {
        $servers = MikrotikServer::all();
        return view('admin.mikrotik.import.form', compact('servers'));
    }

    // Import From Mikrotik (RouterOS API)
    public function importFromMikrotik(Request $request)
    {
        $server = MikrotikServer::findOrFail($request->server_id);

        // RouterOS API connection
        $client = new Client([
            'host' => $server->ip,
            'user' => $server->username,
            'pass' => $server->password,
            'port' => $server->api_port,
        ]);

        // Example: Fetch all active PPP clients
        $response = $client->query('/ppp/active/print')->read();
        // এখানে response থেকে ডেটা process করুন...

        return back()->with('success', 'Clients imported from Mikrotik!');
    }

    // Bulk Clients Import Form
    public function bulkImportForm()
    {
        return view('admin.mikrotik.bulk_import.form');
    }

    // Bulk Clients Import Store
    public function bulkImportStore(Request $request)
    {
        // এখানে CSV/Excel ফাইল process করে clients import করুন
        return back()->with('success', 'Bulk clients imported!');
    }

    public function backupIndex()
{
    // চাইলে এখানে backup list পাঠাতে পারেন
    return view('admin.mikrotik.backups.index');
}
}