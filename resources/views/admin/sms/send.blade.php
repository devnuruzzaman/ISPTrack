@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Send SMS</h3>
                    <button type="button" class="btn btn-info btn-sm" id="checkBalance">Check Balance</button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.sms.send.post') }}" method="POST" id="sendSmsForm">
                        @csrf

                        <div class="form-group">
                            <label for="template_id">Select Template</label>
                            <select name="template_id" id="template_id" class="form-control @error('template_id') is-invalid @enderror" required>
                                <option value="">Choose a template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}"
                                            data-content="{{ $template->content }}"
                                            data-parameters='@json($template->parameters)'>
                                        {{ $template->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('template_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="parameters_container" class="d-none">
                            <h5>Template Parameters</h5>
                            <div id="parameters_fields"></div>
                        </div>

                        <div class="form-group">
                            <label>Preview</label>
                            <div class="border p-3 bg-light" id="message-preview">
                                Select a template to see preview
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="client_ids">Select Clients</label>
                            <select name="client_ids[]" id="client_ids" class="form-control select2 @error('client_ids') is-invalid @enderror" multiple required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">
                                        {{ $client->name }} ({{ $client->phone }})
                                    </option>
                                @endforeach
                            </select>
                            @error('client_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send SMS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select clients",
        theme: 'bootstrap4'
    });

    $('#template_id').change(function() {
        const option = $(this).find('option:selected');
        const content = option.data('content');
        const parameters = option.data('parameters');

        if (content) {
            let preview = content;
            let fields = '';

            if (parameters && Object.keys(parameters).length > 0) {
                Object.keys(parameters).forEach(param => {
                    const val = parameters[param];
                    preview = preview.replace(`{${param}}`, val);
                    fields += `
                        <div class="form-group">
                            <label>${param}</label>
                            <input type="text"
                                   name="parameters[${param}]"
                                   class="form-control parameter-input"
                                   value="${val}"
                                   data-param="${param}">
                        </div>
                    `;
                });
                $('#parameters_fields').html(fields);
                $('#parameters_container').removeClass('d-none');
            } else {
                $('#parameters_container').addClass('d-none');
                $('#parameters_fields').empty();
            }

            $('#message-preview').text(preview);

            $('.parameter-input').on('input', function() {
                let updated = content;
                $('.parameter-input').each(function() {
                    const param = $(this).data('param');
                    updated = updated.replace(`{${param}}`, $(this).val());
                });
                $('#message-preview').text(updated);
            });
        } else {
            $('#message-preview').text('Select a template to see preview');
            $('#parameters_container').addClass('d-none');
            $('#parameters_fields').empty();
        }
    });

    $('#checkBalance').click(function() {
        $.get('{{ route('admin.sms.balance') }}')
            .done(function(response) {
                if (response.success) {
                    alert(`Current Balance: ${response.balance} SMS`);
                } else {
                    alert('Error checking balance: ' + (response.error || 'Unknown error'));
                }
            })
            .fail(function() {
                alert('Failed to check balance');
            });
    });

    $('#sendSmsForm').submit(function() {
        return confirm('Are you sure you want to send this SMS?');
    });
});
</script>
@endpush
