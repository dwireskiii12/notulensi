{{-- @extends('layouts.index')
@section('content')

<div class="stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic form elements</h4>
        <p class="card-description">
          Basic form elements
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
        <h1><a href="{{ route('rooms.create') }}" class="btn btn-primary"> Tambah Data Ruangan</a></h1>

        @if(count($rooms) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $room->room_name }}</td>
                            <td>{{ $room->capacity }}</td>

                            <td>
                                <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning">Ubah</a>
                                <form action="{{ route('rooms.destroy', $room) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada kamar yang tersedia saat ini.</p>
        @endif
      </div>
    </div>
  </div>
@endsection --}}



@extends('layouts.index')

@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Ruangan Rapat</h4>
            <p class="card-description">
                <a href="{{ route('rooms.create') }}" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Add Ruangan Rapat</a>
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
                <table class="table table-bordered table-hover text-center " id="room-table" style="margin-top: 10px; margin-bottom: 10px;">
                    <thead class="table-dark">
                        <tr>
                            <th width="50px">No</th>
                            <th >Nama Ruangan Rapat</th>
                            <th >Kapasitas Ruangan Rapat</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.delete-button', function () {
    var room_id = $(this).data('id');
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
            $('#delete-form-' + room_id).submit();
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#room-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('rooms.index') !!}',
            columns: [
                { data: 'room_id', name: 'room_id' },
                { data: 'room_name', name: 'room_name' },
                {
                    data: 'capacity',
                    name: 'capacity',
                    render: function(data, type, full, meta) {
                        return data + '   Orang';
                    }
                },
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
