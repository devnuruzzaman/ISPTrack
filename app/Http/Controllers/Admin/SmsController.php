<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\SmsLog;
use App\Models\SmsTemplate;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function showSendForm()
    {
        $templates = SmsTemplate::where('is_active', true)->get();
        $clients = Client::where('is_active', true)->get();

        return view('admin.sms.send', compact('templates', 'clients'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:sms_templates,id',
            'client_ids' => 'required|array',
            'client_ids.*' => 'exists:clients,id',
            'custom_parameters' => 'nullable|array'
        ]);

        $template = SmsTemplate::findOrFail($validated['template_id']);
        $clients = Client::whereIn('id', $validated['client_ids'])->get();
        $successCount = 0;
        $failCount = 0;

        foreach ($clients as $client) {
            // Replace parameters in template
            $message = $this->replaceParameters(
                $template->content,
                array_merge(
                    $validated['custom_parameters'] ?? [],
                    ['client_name' => $client->name]
                )
            );

            // Create SMS log
            $smsLog = SmsLog::create([
                'template_id' => $template->id,
                'client_id' => $client->id,
                'phone_number' => $client->phone,
                'message' => $message,
                'status' => 'pending',
                'created_by' => Auth::id()
            ]);

            // Send SMS
            $result = $this->smsService->send($client->phone, $message, $smsLog);

            if ($result['success']) {
                $successCount++;
            } else {
                $failCount++;
            }
        }

        $message = "SMS sent to {$successCount} clients successfully.";
        if ($failCount > 0) {
            $message .= " Failed to send to {$failCount} clients.";
        }

        return redirect()
            ->back()
            ->with('success', $message);
    }

    public function logs()
    {
        $logs = SmsLog::with(['template', 'client', 'creator'])
            ->latest()
            ->paginate(20);

        return view('admin.sms.logs', compact('logs'));
    }

    private function replaceParameters($content, $parameters)
    {
        foreach ($parameters as $key => $value) {
            $content = str_replace('{' . $key . '}', $value, $content);
        }

        return $content;
    }

    public function show($id)
{
    // আপনি চাইলে এখানে sms ডিটেইল দেখাতে পারেন, অথবা শুধু redirect করতে পারেন।
    return redirect()->route('admin.sms-templates.index');
}
}