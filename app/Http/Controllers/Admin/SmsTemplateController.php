<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsTemplateController extends Controller
{
    public function index()
    {
        $templates = SmsTemplate::latest()->paginate(10);
        return view('admin.sms.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.sms.templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sms_templates',
            'content' => 'required|string',
            'type' => 'required|in:billing,support,notification,marketing,other',
            'parameters' => 'nullable|json',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['created_by'] = Auth::id();

        SmsTemplate::create($validated);

        return redirect()
            ->route('admin.sms.templates.index')
            ->with('success', 'SMS template created successfully');
    }

    public function edit(SmsTemplate $smsTemplate)
    {
        return view('admin.sms.templates.edit', compact('smsTemplate'));
    }

    public function update(Request $request, SmsTemplate $smsTemplate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sms_templates,code,' . $smsTemplate->id,
            'content' => 'required|string',
            'type' => 'required|in:billing,support,notification,marketing,other',
            'parameters' => 'nullable|json',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['updated_by'] = Auth::id();

        $smsTemplate->update($validated);

        return redirect()
            ->route('admin.sms.templates.index')
            ->with('success', 'SMS template updated successfully');
    }

    public function destroy(SmsTemplate $smsTemplate)
    {
        $smsTemplate->delete();

        return redirect()
            ->route('admin.sms.templates.index')
            ->with('success', 'SMS template deleted successfully');
    }
}