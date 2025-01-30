
@extends('layouts.index')
@section('content')


<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">
                    {!! session('message') !!}
                </div>
            @endif


            <div class="table-responsive pt-3">
                <table class="table table-bordered table-hover text-center " id="example" style="margin-top: 10px; margin-bottom: 10px;">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Meeting</th>
                            <th>Tema</th>
                            <th>Pemimpin Rapat</th>
                            <th>Tanggal Rapat</th>
                            <th>Waktu Rapat</th>
                            {{-- <th>Hasil Rapat</th> --}}
                            <th>Status Meeting</th>
                            <th>Status Kesimpulan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('conclution-meetings.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'meeting_id', name: 'meeting_id' },
                { data: 'meeting_theme', name: 'meeting_theme' },
                { data: 'leader_name', name: 'leader_name' },
                { data: 'start_time', name: 'start_time' },
                { data: 'time_range', name: 'time_range', searchable: true },
                // { data: 'end_time', name: 'end_time' },
                // { data: 'summary_result', name: 'summary_result' },
                { data: 'meeting_status', name: 'meeting_status' },
                { data: 'status_badge', name: 'status_badge', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
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
