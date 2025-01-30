{{-- @extends('layouts.index')


@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form Hasil Kesimpulan Rapat</h4>
            <div class="form-group col-md-8"><label for="name">Tema Rapat</label><input type="text" class="form-control"
                    id="name" placeholder="Tema Rapat" name="meeting_theme" value="{{ $meeting->meeting_theme ?? '' }}"
readonly></div>
<div class="form-group col-md-8"><label for="name">Pimpinan Rapat</label><input type="text" class="form-control"
        id="name" placeholder="Nama Pemimpin" name="id_users" value="{{ $meeting->leader->name ?? '' }}" readonly></div>
<div class="form-group col-md-8"><label for="name">Sekertaris Rapat</label><input type="text" class="form-control"
        id="name" placeholder="Nama Ruangan" name="id_users" value="{{ $meeting->secretary->name ?? '' }}" readonly>
</div>
<div class="form-group col-md-8"><label for="name">Notulensi Rapat</label><input type="text" class="form-control"
        id="name" placeholder="Nama Ruangan" name="id_users" value="{{ $meeting->user->name ?? '' }}" readonly></div>
<div class="form-group col-md-8"><label for="name">Ruangan Rapat</label><input type="text" class="form-control"
        id="name" placeholder="Nama Ruangan" name="id_users" value="{{ $meeting->rooms->room_name ?? '' }}" readonly>
</div>
<div class="form-group col-md-8"><label for="name">Deskripsi Rapat</label>
    <div class="form-group"><textarea class="form-control" name="summary_result"> {{ $meeting->description }}

</textarea></div>
</div>
<div class="form-group col-md-8"><label for="name">Jadwal Rapat</label><input type="text" class="form-control" id="name"
        placeholder="Nama Ruangan" name="id_users"
        value="{{ $meeting->start_time ?? '' }} sampai {{ $meeting->end_time ?? '' }}" readonly></div>
<div class="form-group col-md-8"><label for="name">Jumlah Peserta Rapat</label><input type="text" class="form-control"
        id="name" placeholder="Nama Ruangan" name="participant_count" value="{{ $meeting->participant_count ?? '' }}"
        readonly></div>
<div class="form-group col-md-8"><label for="participants">Data Peserta Rapat</label>
    <ul>@foreach($meeting->participant as $participant) <li> {{
                        $participant->user->name ?? 'Tidak ditemukan'
                        }}

        </li>@endforeach </ul>
</div>
<div class="form-group col-md-8"><label for="facilities">Data Fasilitas Rapat</label>
    <ol>@if($meeting->facilities) @foreach($meeting->facilities as $index=> $facility) <li>
            {{ $facility->facilities_name }}


        </li>@endforeach @else <li>Fasilitas Tidak Ditemukan</li>@endif </ol>
</div>
<div class="form-group col-md-8"><label for="name">Kesimpulan Rapat</label>
    <div class="form-group"><textarea class="form-control" name="summary_result"> {!! $summaryResult !!}

</textarea></div>
</div>
</div>
</div>
</div>





@endsection --}}


@extends('layouts.index')

@section('content')

<div class="row">

    <div class="col">
        <div class="card card-margin">
            <div class="card-header no-border">
                <div class="card-title mt-2">
                    <h1>{{ $meeting->meeting_theme }}</h1>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="widget-49">
                    <div class="widget-49-title-wrapper">
                        <div class="widget-49-date-success">
                            <span class="widget-49-date-day">
                                <h5>{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('d') ?? '' }}
                                </h5>
                            </span>
                            <span
                                class="widget-49-date-month">{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('F') ?? '' }}</span>
                        </div>
                        <div class="widget-49-meeting-info">
                            <span class="widget-49-pro-title">
                                <h3>{{ $meeting->description }}</h3>
                            </span>
                            <span class="widget-49-meeting-time">
                                <h4>
                                    <div class="badge badge-danger">
                                        {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }}
                                        WITA ~
                                        {{ \Carbon\Carbon::parse($meeting->end_time)->locale('id')->translatedFormat(' H:i') ?? '' }}
                                        WITA </div>
                                </h4>
                            </span>
                        </div>
                    </div>

                    <div class="row">

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
                            </div>

                            <div class="form-group">
                                <label for="PR">Daftar Peserta Rapat:</label>
                                <div class="input-like-disabled">
                                    <ol class="widget-49-meeting-points" id="PR">
                                        @if($meeting->participants->isNotEmpty())
                                        @foreach($meeting->participants as $participant)
                                        <li class="widget-49-meeting-item"><span>{{ $participant->name }}</span></li>
                                        @endforeach
                                        @else
                                        <li class="widget-49-meeting-item"><span>Peserta Tidak Ditemukan</span></li>
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
                                <label for="leader">Ruangan Rapat:</label>
                                <input type="text" id="leader" class="form-control costum-input"
                                    value="{{ $meeting->rooms->room_name }}" disabled>
                            </div>


                            <div class="form-group">
                                <label for="FR">Daftar Fasilitas Rapat:</label>
                                <div class="input-like-disabled">
                                    <ol class="widget-49-meeting-points" id="FR">
                                        @if($meeting->facilities->isNotEmpty())
                                        @foreach($meeting->facilities as $facility)
                                        <li class="widget-49-meeting-item"><span>{{ $facility->facilities_name }}</span>
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="widget-49-meeting-item"><span>Fasilitas Tidak Ditemukan</span></li>
                                        @endif
                                    </ol>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="minutes">Notulensi Rapat:</label>
                                <input type="text" id="minutes" class="form-control costum-input"
                                    value="{{ $meeting->minutes ? $meeting->minutes->name : 'Notulensi Tidak Ditemukan' }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="leader">Jadwal:</label>
                                <input type="text" id="leader" class="form-control costum-input"
                                    value="{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }} "
                                    disabled>
                            </div>


                            <div class="form-group">
                                <label for="status"> Status Rapat</label>
                                <input type="text" class="form-control" value="{{ $meeting->status }}" id="status"
                                    disabled>
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="name">Kesimpulan Rapat</label>
                            <div class="input-like-disabled">
                                {!! $summaryResult !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="widget-49-meeting-action">
                                <a href="{{ route('meeting.meetingresult') }}" class="btn  btn-danger">Kembali</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
