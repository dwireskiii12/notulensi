@extends('layouts.index')

@section('content')

<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Hasil Rapat</h4>
            <p class="card-description">
                {{-- <a href="{{ url('meeting-create') }}" class="btn btn-success">Jadwalkan Rapat</a> --}}
            </p>
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive pt-3">
                <table class="table table-bordered table-hover text-center" id="summary-table" style="margin-top: 10px; margin-bottom: 10px;">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Notulensi Rapat</th>
                            <th>Pemimpin Rapat</th>
                            <th>Tanggal</th>
                            <th>Waktu Rapat</th>
                            <th>Peserta</th>
                            <th>Ruangan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#summary-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('meeting.meetingresult') !!}',
            columns: [
                { data: 'meeting_id', name: 'meeting_id' },
                { data: 'meeting_theme', name: 'meeting_theme' },
                { data: 'minutes', name: 'minutes.name' },
                { data: 'leader', name: 'leader.name' },
                { data: 'start_time', name: 'start_time' },
                { data: 'time_range', name: 'time_range', searchable: true },
                { data: 'participant_count', name: 'participant_count' },
                { data: 'rooms', name: 'rooms.room_name' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[0, 'asc']],
            drawCallback: function(settings) {
            var api = this.api();
            var startIndex = api.context[0]._iDisplayStart;
            api.column(0).nodes().each(function(cell, i) {
                cell.innerHTML = startIndex + i + 1;
            });
            }
        });
    });


//     $(document).ready(function() {
//     $('#summary-table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: '{{ route('meeting.meetingresult') }}',
//             type: 'GET'
//         },
//         columns: [
//             { data: 'start_time', name: 'start_time' },
//             {
//                 data: 'time_range',
//                 name: 'time_range',
//                 render: function(data, type, full, meta) {
//                     return full.jam_masuk + ' - ' + full.end_time;
//                 },
//                 searchable: true // Ensure this column is searchable
//             },
//             // Other columns...
//             { data: 'action', name: 'action', orderable: false, searchable: false },
//             { data: 'minutes', name: 'minutes' },
//             { data: 'leader', name: 'leader' },
//             { data: 'rooms', name: 'rooms' },
//             { data: 'status', name: 'status', orderable: false, searchable: false }
//         ]
//     });
// });

</script>

@endsection
