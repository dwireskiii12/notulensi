@extends('layouts.index')

@section('content')

<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Penjadwalan Rapat</h4>
            <p class="card-description">
                <a href="{{ url('meeting-create') }}" class="btn btn-success">Jadwalkan Rapat</a>
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form class="form-inline" action="{{ route('meeting.index') }}" method="GET">
                        <div class="form-group">
                            <label for="perPage" class="mr-2">Tampilkan per halaman:</label>
                            <select id="perPage" class="form-control" style="width: 80px;"
                                onchange="changePerPage(this.value)">
                                <option value="10" {{ Request::get('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ Request::get('perPage') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ Request::get('perPage') == 50 ? 'selected' : '' }}>50</option>
                                <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                    </form>
                </div>

                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            {{-- <th>Sekretaris</th> --}}
                            <th width="150px">Judul</th>
                            <th>Notulensi Rapat</th>
                            <th>Pemimpin Rapat</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Peserta</th>
                            <th>Ruangan</th>
                            <th>Status</th>
                            <th width="380px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meetings as $mt)
                        <tr>


                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $mt->meeting_theme }}</td>
                            <td>{{ $mt->minutes ? $mt->minutes->name : 'Minutes Not Found' }}</td>
                            <td>{{ $mt->leader ? $mt->leader->name : 'Leader Not Found' }}</td>
                            <td>{{ $mt->start_time }}</td>
                            <td>{{ $mt->end_time }}</td>
                            <td>{{ $mt->participant_count }} Orang</td>
                            <td>{{ $mt->rooms ? $mt->rooms->room_name : 'Room Not Found' }}</td>
                            <td><span class="badge badge-danger">{{ $mt->status }}</span></td>
                            <td>
                                <form action="{{ route('meeting.destroy', $mt->meeting_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="btn btn-dark" onclick="return confirm('Apakah Anda yakin ingin membatalkan pertemuan ini?')">Batalkan Rapat</button>
                                </form>
                                <a href="{{ route('meeting.edit', $mt->meeting_id) }}" class="btn btn-warning d-inline">Edit Jadwal</a>
                                <a href="{{ route('meeting.preview', $mt->meeting_id) }}" class="btn btn-primary ">Ajukan Rapat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>



@endsection


