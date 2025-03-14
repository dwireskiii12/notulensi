@extends('layouts.index')

@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Pegawai</h4>
            <p class="card-description">
                <a href="{{ route('users.create') }}" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Add Pegawai</a>
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
                <table class="table table-bordered table-hover text-center " id="user-table" style="margin-top: 10px; margin-bottom: 10px;">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Posisi</th>
                            <th>Telepon</th>
                            <th>Fakultas</th>
                            <th>Program Study</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.delete-button', function () {
    var user_id = $(this).data('id');
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the corresponding form
            $('#delete-form-' + user_id).submit();
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('users.index') !!}',
            columns: [
                { data: 'user_id', name: 'user_id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role_name', name: 'role_name' },
                { data: 'position', name: 'position' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'faculty', name: 'faculty' },
                { data: 'study_program', name: 'study_program' },
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
