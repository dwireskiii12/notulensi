

@extends('layouts.index')

@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Penjadwalan Rapat</h4>
            <p class="card-description">
                <a href="{{ url('meeting-create') }}" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Jadwalkan Rapat</a>
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
                <table class="table table-bordered table-hover text-center " id="meetings-table" style="margin-top: 10px; margin-bottom: 10px;">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th width="150px">Judul</th>
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
<script>
    $(document).on('click', '.cancel-button', function () {
    var room_id = $(this).data('id');
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Anda ingin membatalkan pertemuan rapat!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Cancel!',
        cancelButtonText: 'Back'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the corresponding form
            $('#delete-form-' + room_id).submit();
        }
    });
});
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#meetings-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('meeting.index') !!}',
            columns: [
                { data: 'meeting_id', name: 'meeting_id' },
                { data: 'meeting_theme', name: 'meeting_theme' },
                { data: 'minutes', name: 'minutes.name' },
                { data: 'leader', name: 'leader.name' },
                { data: 'start_time', name: 'start_time' },
                { data: 'time_range', name: 'time_range', searchable: true },
                // {
                //     data: null,
                //     name: 'time_range',
                //     render: function(data, type, full, meta) {
                //         return full.jam_masuk + ' - ' + full.end_time;
                //     }
                // },
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
</script>

@endsection
