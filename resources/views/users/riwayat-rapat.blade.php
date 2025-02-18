@extends('layouts.index')
<link rel="stylesheet" href="{{ asset('template/css/cardmeeting.css') }}">
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Seluruh Hasil Rapat
                </h4>
                <h4> <form action="{{ route('users-result-meetings.resultusermeeting') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="title" class="form-control" placeholder="Search by title" value="{{ request('title') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="leader" class="form-control" placeholder="Search by leader" value="{{ request('leader') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success">Search</button>
                            <a href="{{ route('users-result-meetings.resultusermeeting') }}" class="btn btn-secondary">Clear Filter</a>
                        </div>
                        </div>
                    </div>
                </form></h4>
                <div class="event">
                    <div class="row">
                        <div class="col-lg-12">

                                    @if ($meetingsAllDay->count() > 0)
                                        @foreach ($meetingsAllDay as $meeting)
                                            <!-- Row loop -->
                                            <div class="row mb-5">
                                                <div class="col-lg-2">
                                                    <div class="user">
                                                        <div class="title text-center">
                                                            <img src="{{ asset('img/'.$meeting->leader->image) }}" class="m-2" alt="img">
                                                            <h5>{{ $meeting->leader->name }}</h5>
                                                            <p>Pemimpin Rapat</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10">
                                                    <div class="event-list-content fix">
                                                        <ul data-animation="fadeInUp animated" data-delay=".2s" style="animation-delay: 0.2s;" class="">
                                                            <li><i class="fas fa-map-marker-alt"></i> {{ $meeting->rooms->room_name }}</li>
                                                            <li><i class="far fa-clock"></i> {{ $meeting->start_time->format('H:i') }} - {{ $meeting->end_time->format('H:i') }}</li>
                                                            <li><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('l, d F Y') }}</li>
                                                        </ul>

                                                        <h2>{{ $meeting->meeting_theme }}</h2>
                                                        <p>{{ $meeting->description }}</p>
                                                        <a href="{{ route('users-meetings.detailuserresult', $meeting->meeting_id) }}" class="btn btn-outline-dark btn-icon-text mt-2">
                                                            <i class="mdi mdi-open-in-new btn-icon-text"></i>
                                                            Read More
                                                        </a>
                                                        <div class="crical"><i class="mdi mdi-linux"></i></div>
                                                    </div>
                                                </div>
                                                </div>
                                            <!-- End of row loop -->
                                        @endforeach

                                        {{ $meetingsAllDay->links('vendor.pagination.bootstrap-4') }}

                                        <!-- Tampilkan pagination untuk tab "Meeting All Day" -->

                                    @else
                                        <p>No meetings available.</p>
                                    @endif
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

