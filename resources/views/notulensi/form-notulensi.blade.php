@extends('layouts.index')
@section('content')



<div class="col">
    <div class="card card-margin">
        <div class="card-header no-border">
            <div class="card-title mt-2">
                <h1>{{ $summary->meeting->meeting_theme }}</h1>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="widget-49">
                <div class="widget-49-title-wrapper">
                    <div class="widget-49-date-success">
                        <span class="widget-49-date-day">
                            <h5>{{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('d') ?? '' }}
                            </h5>
                        </span>
                        <span
                            class="widget-49-date-month">{{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('F') ?? '' }}</span>
                    </div>
                    <div class="widget-49-meeting-info">
                        <span class="widget-49-pro-title">
                            <h3>{{ $summary->meeting->description }}</h3>
                        </span>
                        <span class="widget-49-meeting-time">
                            <h4>
                                <div class="badge badge-danger">
                                    {{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }}
                                    WITA ~
                                    {{ \Carbon\Carbon::parse($summary->meeting->end_time)->locale('id')->translatedFormat(' H:i') ?? '' }}
                                    WITA </div>
                            </h4>
                        </span>
                    </div>
                </div>
                <form class="forms-sample mt-2" action="" method="POST">

                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="name">Pimpinan Rapat</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Pemimpin"
                                name="id_users" value="{{ $summary->meeting->leader->name ?? '' }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">Sekertaris Rapat</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Ruangan" name="id_users"
                                value="{{ $summary->meeting->secretary->name ?? '' }}" readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name">Notulensi Rapat</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Ruangan" name="id_users"
                                value="{{ $summary->user->name ?? '' }}" readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name">Ruangan Rapat</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Ruangan" name="id_users"
                                value="{{ $summary->meeting->rooms->room_name ?? '' }}" readonly>
                        </div>



                        <div class="form-group col-md-4">
                            <label for="name">Jadwal Rapat</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Ruangan" name="id_users"
                                value=" {{ \Carbon\Carbon::parse($summary->meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }} "
                                readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name">Jumlah Peserta Rapat</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Ruangan"
                                name="participant_count" value="{{ $summary->meeting->participant_count ?? '' }} Orang"
                                readonly>
                        </div>





                        <div class="form-group col-md-6">
                            <label for="participants">Data Peserta Rapat</label>
                            <div class="input-like-disabled">
                            <ul class="widget-49-meeting-points" id="PR">
                                @foreach($summary->meeting->participant as $participant)
                                <li class="widget-49-meeting-item">{{ $participant->user->name ?? 'Tidak ditemukan' }}</li>
                                @endforeach
                            </ul>
                        </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="participants">Data Fasilitas</label>
                            <div class="input-like-disabled">
                            <ul class="widget-49-meeting-points" id="FR">
                                @if($summary->meeting->facilities)
                                @foreach($summary->meeting->facilities as $index => $facility)
                                <li class="widget-49-meeting-item">{{ $facility->facilities_name }}</li>
                                @endforeach
                                @else
                                <li class="widget-49-meeting-item">Fasilitas Tidak Ditemukan</li>
                                @endif
                            </ul>
                        </div>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="name">Kesimpulan Rapat</label>
                            <div class="form-group">
                                <textarea class="form-control" name="summary_result"
                                    id="summernote">{!! $summary->summary_result !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="action" value="save" class="btn btn-primary me-2">Save</button>
                    <button type="submit" name="action" value="publish" class="btn btn-success me-2">Publish</button>

                    <a href="{{ route('conclution-meetings.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
