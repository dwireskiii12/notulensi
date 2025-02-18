@extends('layouts.index')

@section('content')

<div class="row">
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
                            <div class="widget-49-meeting-action">
                                <form action="{{ route('meeting.sendInvitation', $meeting->meeting_id) }}" method="POST"
                                    class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Kirim Undangan</button>
                                    <a href="{{ route('meeting.index') }}" class="btn  btn-danger">Kembali</a>
                                </form>
                            </div>
                        </div>





                    </div>












                </div>
            </div>
        </div>
    </div>
</div>

@endsection
