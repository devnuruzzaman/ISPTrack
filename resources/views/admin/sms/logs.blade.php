@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SMS Logs</h3>
                </div>
                <div class="card-body">
                    <form id="filter-form" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">All</option>
                                        <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Client</label>
                                    <select name="client_id" class="form-control select2">
                                        <option value="">All Clients</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}"
                                                    {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Template</label>
                                    <select name="template_id" class="form-control select2">
                                        <option value="">All Templates</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}"
                                                    {{ request('template_id') == $template->id ? 'selected' : '' }}>
                                                {{ $template->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Range</label>
                                    <input type="text" name="date_range" class="form-control daterange"
                                           value="{{ request('date_range') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.sms.logs') }}" class="btn btn-default">Reset</a>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Template</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>{{ $log->sent_at->format('Y-m-d H:i:s') }}</td>
                                        <td>{{ $log->client->name ?? 'N/A' }}</td>
                                        <td>{{ $log->template->name ?? 'N/A' }}</td>
                                        <td>{{ $log->phone_number }}</td>
                                        <td>{{ Str::limit($log->message, 50) }}</td>
                                        <td>
                                            @if($log->status == 'sent')
                                                <span class="badge badge-success">Sent</span>
                                            @else
                                                <span class="badge badge-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-sm btn-info view-details"
                                                    data-toggle="modal"
                                                    data-target="#detailsModal"
                                                    data-log="{{ json_encode($log) }}">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No logs found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $logs->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SMS Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Date:</strong> <span id="modal-date"></span></p>
                        <p><strong>Client:</strong> <span id="modal-client"></span></p>
                        <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
                        <p><strong>Template:</strong> <span id="modal-template"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong> <span id="modal-status"></span></p>
                        <p><strong>Message ID:</strong> <span id="modal-message-id"></span></p>
                        <p><strong>Gateway:</strong> <span id="modal-gateway"></span></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Message Content</h6>
                        <pre id="modal-message" class="bg-light p-3"></pre>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Response Data</h6>
                        <pre id="modal-response" class="bg-light p-3"></pre>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();

    $('.daterange').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.view-details').click(function() {
        const log = $(this).data('log');

        $('#modal-date').text(moment(log.sent_at).format('YYYY-MM-DD HH:mm:ss'));
        $('#modal-client').text(log.client ? log.client.name : 'N/A');
        $('#modal-phone').text(log.phone_number);
        $('#modal-template').text(log.template ? log.template.name : 'N/A');
        $('#modal-status').text(log.status);
        $('#modal-message-id').text(log.message_id || 'N/A');
        $('#modal-gateway').text(log.gateway);
        $('#modal-message').text(log.message);

        try {
            const response = JSON.parse(log.response_data);
            $('#modal-response').text(JSON.stringify(response, null, 2));
        } catch (e) {
            $('#modal-response').text(log.response_data || 'No response data');
        }
    });
});
</script>
@endpush