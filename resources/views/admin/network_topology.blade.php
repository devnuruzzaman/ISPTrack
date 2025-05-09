@extends('layouts.admin')
@section('content')
    <h1>Network Topology View</h1>

    {{-- Export and Map Upload --}}
    <div class="mb-3">
        <button id="exportBtn" class="btn btn-success">Export as Image</button>
        <form id="mapUploadForm" action="{{ route('admin.network-topology.upload-map') }}" method="POST" enctype="multipart/form-data" style="display:inline;">
            @csrf
            <input type="file" name="background_map" accept="image/*" onchange="document.getElementById('mapUploadForm').submit()" style="display:inline;">
        </form>
    </div>

    {{-- Topology Container --}}
    <div id="network" style="width: 100%; height: 600px; border:1px solid #ccc; background-repeat:no-repeat; background-size:contain; background-position:center;"></div>

    {{-- Add/Edit Device Modal (example, implement as needed) --}}
    <!-- ... -->

@endsection

@section('scripts')
    <!-- vis.js CDN -->
    <script src="https://unpkg.com/vis-network@9.1.2/dist/vis-network.min.js"></script>
    <link href="https://unpkg.com/vis-network@9.1.2/styles/vis-network.min.css" rel="stylesheet" />

    <script>
        // ডেটা: ডিভাইস ও লিঙ্ক (Controller থেকে JSON encode করে পাঠান)
        let nodes = {!! json_encode($nodes) !!};
        let edges = {!! json_encode($edges) !!};
        let backgroundMap = @json($backgroundMapUrl ?? '');

        // vis.js দিয়ে নেটওয়ার্ক ড্র
        const container = document.getElementById('network');
        const data = { nodes: new vis.DataSet(nodes), edges: new vis.DataSet(edges) };
        const options = {
            physics: { enabled: true },
            edges: { arrows: 'to' }
        };
        const network = new vis.Network(container, data, options);

        // ব্যাকগ্রাউন্ড ম্যাপ (optional)
        if(backgroundMap) {
            container.style.backgroundImage = 'url(' + backgroundMap + ')';
        }

        // Export as Image
        document.getElementById('exportBtn').onclick = function() {
            html2canvas(container).then(canvas => {
                let link = document.createElement('a');
                link.download = 'network_topology.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        };
    </script>
    <!-- html2canvas for export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
@endsection