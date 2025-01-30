@extends('layouts.index')
<style>

    .input-like-disabled {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    appearance: none;
    cursor: not-allowed;
}
</style>
@section('content')

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

<div class="card">



    <div class="card-body">
        <h4 class="card-title">Edit Data Rapat</h4>


        <form action="{{ route('meeting.update', $meeting->meeting_id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Tampilkan detail rapat sebelumnya -->

            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="theme">Tema Rapat:</label>
                        <label></label>
                        <input type="text" id="theme" class="form-control costum-input"
                            value="{{ $meeting->meeting_theme }}" disabled>
                    </div>


                    <div class="form-group">
                        <label for="minutes">Notulensi Rapat:</label>
                        <input type="text" id="minutes" class="form-control costum-input"
                            value="{{ $meeting->minutes ? $meeting->minutes->name : 'Notulensi Tidak Ditemukan' }}"
                            disabled>
                        <label></label>
                    </div>


                    <div class="form-group">
                        <label for="participants">Daftar Peserta Rapat:</label>
                        <div class="input-like-disabled">

                            <ol>
                                @if($meeting->participants->isNotEmpty())
                                    @foreach($meeting->participants as $participant)
                                        <li>{{ $participant->name }}</li>
                                    @endforeach
                                @else
                                    <li>Peserta Tidak Ditemukan</li>
                                @endif
                            </ol>
                    </div>
                    </div>

                </div>


                <div class="col-md-4">


                    <div class="form-group">
                        <label for="participant_count">Pemimpin Rapat:</label>
                        <input type="text" id="participant_count" class="form-control costum-input"
                            value="{{ $meeting->leader ? $meeting->leader->name : 'Notulensi Tidak Ditemukan' }}"
                            disabled>
                    </div>

                    <div class="form-group">
                        <label for="leader">Jumlah Peserta Rapat:</label>
                        <input type="text" id="leader" class="form-control costum-input"
                            value="{{ $meeting->participant_count }} orang" disabled>

                            <input type="text" id="leader"  name="participant_count" class="form-control costum-input"
                            value="{{ $meeting->participant_count }}" hidden>
                    </div>



                    <div class="form-group">
                        <label for="facilities">Fasilitas Rapat:</label>
                        <div class="input-like-disabled">

                            <ol>
                                @if($meeting->facilities->isNotEmpty())
                                    @foreach($meeting->facilities as $facility)
                                        <li>{{ $facility->facilities_name }}</li>
                                    @endforeach
                                @else
                                    <li>Fasilitas Tidak Ditemukan</li>
                                @endif
                            </ol>
                    </div>
                    </div>






                </div>



                <div class="col-md-4">
                    <div class="form-group">
                        <label for="minutes">Sekertaris Rapat:</label>
                        <input type="text" id="minutes" class="form-control costum-input"
                            value="{{ $meeting->secretary ? $meeting->secretary->name : 'Notulensi Tidak Ditemukan' }}"
                            disabled>
                    </div>

                    <div class="form-group">
                        <label for="start_time">Waktu Mulai:</label>
                        <input type="datetime-local" id="start_time" name="start_time" class="form-control"
                            value="{{ $meeting->start_time }}">
                    </div>

                    <div class="form-group">
                        <label for="end_time">Waktu Selesai:</label>
                        <input type="datetime-local" id="end_time" name="end_time" class="form-control"
                            value="{{ $meeting->end_time }}">
                    </div>

                    <div class="form-group">
                        <label for="room_id">Ruangan:</label>
                        <select id="room_id" name="room_id" class="js-example-basic-single w-100">
                            @foreach($room as $room)
                            <option value="{{ $room->room_id }}"
                                {{ $meeting->room_id == $room->room_id ? 'selected' : '' }}>{{ $room->room_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ url('meeting') }}" class="btn btn-dark"> Batal Perubahan</a>
                </div>



                    </div>

            </div>
        </form>

    </div>
</div>
@endsection
