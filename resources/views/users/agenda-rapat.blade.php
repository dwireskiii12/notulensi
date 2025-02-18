@extends('layouts.index')
@stack('css')
<link rel="stylesheet" href="{{ asset('template/css/cardmeeting.css') }}">
@section('content')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List of Meetings</h4>
               <div class="container"> <h4 class="card-title">


                <form action="{{ route('users-meetings.index') }}" method="GET" class="mb-4">
<div class="row">
    <div class="col-md-3">
        <input type="text" name="title" class="form-control" placeholder="Search by title"
            value="{{ request('title') }}">
    </div>
    <div class="col-md-3">
        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
    </div>
    <div class="col-md-3">
        <input type="text" name="leader" class="form-control" placeholder="Search by leader"
            value="{{ request('leader') }}">
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</div>
</form>
</h4>
</div>

<div class="event">

    <div class="row">

        <div class="col-lg-12">
            <nav class="wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s"
                style="visibility: visible; animation-name: fadeInDown;">
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link {{ $activeTab == 'one' ? 'active show' : '' }}" id="nav-home-tab"
                        data-toggle="tab" href="#one" role="tab" aria-selected="true">
                        <div class="nav-content">
                            <strong>Meeting In Day</strong>
                            <span>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                        </div>
                    </a>
                    <a class="nav-item nav-link {{ $activeTab == 'two' ? 'active show' : '' }}" id="nav-profile-tab"
                        data-toggle="tab" href="#two" role="tab" aria-selected="false">
                        <div class="nav-content">
                            <strong>Meeting All Day</strong>
                            <span>Semua Agenda Rapat</span>
                        </div>
                    </a>
                </div>
            </nav>



            <div class="tab-content py-3 px-3 px-sm-0 wow fadeInDown animated" data-animation="fadeInDown animated"
                data-delay=".2s" id="nav-tabContent" style="visibility: visible; animation-name: fadeInDown;">
                <div class="tab-pane fade {{ $activeTab == 'one' ? 'active show' : '' }}" id="one" role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    @if ($meetingsInDay->count() > 0)
                    @foreach ($meetingsInDay as $meeting)
                    <!-- Row loop -->
                    <div class="row mb-30">
                        <div class="col-lg-2">

                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('img/', $meeting->leader->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5>{{ $meeting->leader->name }}</h5>
                                    <p>Pemimpin Rapat</p>
                                </div>
                            </div>
                            <div class="user">
                                <div class="title text-center">

                                    <img src="{{ asset('img/', $meeting->leader->image) }}" alt="img">
                                    <h5>{{ $meeting->leader->name }}</h5>
                                    <p>Pemimpin Rapat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="event-list-content fix">
                                <ul data-animation="fadeInUp animated" data-delay=".2s" style="animation-delay: 0.2s;"
                                    class="">
                                    <li><i class="fas fa-map-marker-alt"></i> {{ $meeting->rooms->room_name }}</li>
                                    <li><i class="far fa-clock"></i> {{ $meeting->start_time->format('H:i') }} -
                                        {{ $meeting->end_time->format('H:i') }}</li>
                                    <li><i class="far fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('l, d F Y') }}
                                    </li>
                                </ul>
                                <h2>{{ $meeting->meeting_theme }}</h2>
                                <p>{{ $meeting->description }}</p>
                                <a href="{{ route('users-meetings.detailscheduleuser', $meeting->meeting_id) }}"
                                    class="btn btn-outline-dark btn-icon-text mt-2">
                                    <i class="mdi mdi-open-in-new btn-icon-text"></i>
                                    Read More
                                </a>
                                <div class="crical"><i class="mdi mdi-linux"></i></div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Tampilkan pagination untuk tab "Meeting In Day" -->
                    {{ $meetingsInDay->appends(['tab' => 'one'])->links() }}

                    @else
                    <p>No meetings available for today.</p>
                    @endif
                </div>

                <div class="tab-pane fade {{ $activeTab == 'two' ? 'active show' : '' }}" id="two" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
                    @if ($meetingsAllDay->count() > 0)
                    @foreach ($meetingsAllDay as $meeting)
                    <!-- Row loop -->

                    <div class="row mb-30">
                        <div class="col-lg-2">

                            <div class="user mt-5">
                                <div class="title text-center">
                                    <img src="{{ asset('img/'. $meeting->leader->image) }}" alt="img" width="150px"
                                        height="150px">
                                    <h5>{{ $meeting->leader->name }}</h5>
                                    <p>Pemimpin Rapat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="event-list-content fix">
                                <ul data-animation="fadeInUp animated" data-delay=".2s" style="animation-delay: 0.2s;"
                                    class="">
                                    <li><i class="fas fa-map-marker-alt"></i> {{ $meeting->rooms->room_name }}</li>
                                    <li><i class="far fa-clock"></i> {{ $meeting->start_time->format('H:i') }} -
                                        {{ $meeting->end_time->format('H:i') }}</li>
                                    <li><i class="far fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('l, d F Y') }}
                                    </li>
                                </ul>
                                <h2>{{ $meeting->meeting_theme }}</h2>
                                <p>{{ $meeting->description }}</p>
                                <a href="{{ route('users-meetings.detailscheduleuser', $meeting->meeting_id) }}"
                                    class="btn btn-outline-dark btn-icon-text mt-2">
                                    <i class="mdi mdi-open-in-new btn-icon-text"></i>
                                    Read More
                                </a>
                                <div class="crical"><i class="mdi mdi-linux"></i></div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-danger">
                    <!-- End of row loop -->
                    @endforeach

                    {{ $meetingsAllDay->appends(['tab' => 'two'])->links('pagination::bootstrap-4', ['class' => 'custom-pagination']) }}

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
</div>
--}}



<style>
    body {
        margin-top: 20px;
    }

    .event-schedule-area .section-title .title-text {
        margin-bottom: 50px;
    }

    .event-schedule-area .tab-area .nav-tabs {
        border-bottom: inherit;
    }

    .event-schedule-area .tab-area .nav {
        border-bottom: inherit;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        margin-top: 80px;
    }

    .event-schedule-area .tab-area .nav-item {
        margin-bottom: 75px;
    }

    .event-schedule-area .tab-area .nav-item .nav-link {
        text-align: center;
        font-size: 22px;
        color: #333;
        font-weight: 600;
        border-radius: inherit;
        border: inherit;
        padding: 0px;
        text-transform: capitalize !important;
    }

    .event-schedule-area .tab-area .nav-item .nav-link.active {
        color: #4125dd;
        background-color: transparent;
    }

    .event-schedule-area .tab-area .tab-content .table {
        margin-bottom: 0;
        width: 80%;
    }

    .event-schedule-area .tab-area .tab-content .table thead td,
    .event-schedule-area .tab-area .tab-content .table thead th {
        border-bottom-width: 1px;
        font-size: 20px;
        font-weight: 600;
        color: #252525;
    }

    .event-schedule-area .tab-area .tab-content .table td,
    .event-schedule-area .tab-area .tab-content .table th {
        border: 1px solid #b7b7b7;
        padding-left: 30px;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th .heading,
    .event-schedule-area .tab-area .tab-content .table tbody td .heading {
        font-size: 16px;
        text-transform: capitalize;
        margin-bottom: 16px;
        font-weight: 500;
        color: #252525;
        margin-bottom: 6px;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th span,
    .event-schedule-area .tab-area .tab-content .table tbody td span {
        color: #4125dd;
        font-size: 18px;
        text-transform: uppercase;
        margin-bottom: 6px;
        display: block;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th span.date,
    .event-schedule-area .tab-area .tab-content .table tbody td span.date {
        color: #656565;
        font-size: 14px;
        font-weight: 500;
        margin-top: 15px;
    }

    .event-schedule-area .tab-area .tab-content .table tbody th p {
        font-size: 14px;
        margin: 0;
        font-weight: normal;
    }

    .event-schedule-area-two .section-title .title-text h2 {
        margin: 0px 0 15px;
    }

    .event-schedule-area-two ul.custom-tab {
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 30px;
    }

    .event-schedule-area-two ul.custom-tab li {
        margin-right: 70px;
        position: relative;
    }

    .event-schedule-area-two ul.custom-tab li a {
        color: #252525;
        font-size: 25px;
        line-height: 25px;
        font-weight: 600;
        text-transform: capitalize;
        padding: 35px 0;
        position: relative;
    }

    .event-schedule-area-two ul.custom-tab li a:hover:before {
        width: 100%;
    }

    .event-schedule-area-two ul.custom-tab li a:before {
        position: absolute;
        left: 0;
        bottom: 0;
        content: "";
        background: #4125dd;
        width: 0;
        height: 2px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two ul.custom-tab li a.active {
        color: #4125dd;
    }

    .event-schedule-area-two .primary-btn {
        margin-top: 40px;
    }

    .event-schedule-area-two .tab-content .table {
        -webkit-box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 0;
    }

    .event-schedule-area-two .tab-content .table thead {
        background-color: #007bff;
        color: #fff;
        font-size: 20px;
    }

    .event-schedule-area-two .tab-content .table thead tr th {
        padding: 20px;
        border: 0;
    }

    .event-schedule-area-two .tab-content .table tbody {
        background: #fff;
    }

    .event-schedule-area-two .tab-content .table tbody tr.inner-box {
        border-bottom: 1px solid #dee2e6;
    }

    .event-schedule-area-two .tab-content .table tbody tr th {
        border: 0;
        padding: 30px 20px;
        vertical-align: middle;
    }

    .event-schedule-area-two .tab-content .table tbody tr th .event-date {
        color: #252525;
        text-align: center;
    }

    .event-schedule-area-two .tab-content .table tbody tr th .event-date span {
        font-size: 50px;
        line-height: 50px;
        font-weight: normal;
    }

    .event-schedule-area-two .tab-content .table tbody tr td {
        padding: 30px 20px;
        vertical-align: middle;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .r-no span {
        color: #252525;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap h3 a {
        font-size: 20px;
        line-height: 20px;
        color: #cf057c;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap h3 a:hover {
        color: #4125dd;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .categories {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        margin: 10px 0;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .categories a {
        color: #252525;
        font-size: 16px;
        margin-left: 10px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .categories a:before {
        content: "\f07b";
        font-family: fontawesome;
        padding-right: 5px;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .time span {
        color: #252525;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        margin: 10px 0;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers a {
        color: #4125dd;
        font-size: 16px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers a:hover {
        color: #4125dd;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-wrap .organizers a:before {
        content: "\f007";
        font-family: fontawesome;
        padding-right: 5px;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .primary-btn {
        margin-top: 0;
        text-align: center;
    }

    .event-schedule-area-two .tab-content .table tbody tr td .event-img img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
    }
</style>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="event-schedule-area-two card pad100">

    <!-- row end-->
    <div class="row">
        <div class="col-lg-12">
            <nav class="wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s"
                style="visibility: visible; animation-name: fadeInDown;">
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link {{ $activeTab == 'one' ? 'active show' : '' }}" id="home-taThursday"
                        data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        <div class="nav-content">
                            <strong> In Day</strong>
                            <span>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                        </div>
                    </a>
                    <a class="nav-item nav-link {{ $activeTab == 'two' ? 'active show' : '' }}" id="profile-tab"
                        data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        <div class="nav-content">
                            <strong> All Day</strong>
                        </div>
                    </a>
                </div>
            </nav>
            {{-- <ul class="nav custom-tab" id="myTab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'one' ? 'active show' : '' }}" id="home-taThursday"
            data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">In Day</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeTab == 'two' ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                    href="#profile" role="tab" aria-controls="profile" aria-selected="false"> All Day</a>
            </li>

            </ul> --}}
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $activeTab == 'one' ? 'active show' : '' }}" id="home" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table" id="homes">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center" scope="col">Tanggal</th>
                                    <th scope="col" class="text-center">Pimpinan Rapat</th>
                                    <th scope="col">Informasi Rapat</th>
                                    <th scope="col">Ruangan</th>
                                    <th scope="col">Status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($meetingsInDay->count() > 0)
                                @foreach ($meetingsInDay as $meeting)


                                <tr class="inner-box">
                                    <th scope="row">
                                        <div class="event-date">
                                            <span>{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('d') }}</span>
                                            <p>{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('F') }}
                                            </p>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="event-img">
                                            <img src="{{ asset('img/'.$meeting->leader->image) }}" alt="" />
                                        </div>

                                    </td>
                                    <td>
                                        <div class="event-wrap">
                                            <h3><a href="#">{{ $meeting->meeting_theme }} </a></h3>
                                            <div class="meta">
                                                <div class="organizers">
                                                    <a href="#">{{ $meeting->leader->name }}</a>
                                                </div>

                                                <div class="time">
                                                    <span><i class="far fa-clock"></i>
                                                        {{ $meeting->start_time->format('H:i') }} -
                                                        {{ $meeting->end_time->format('H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="r-no">
                                            <span><i class="fas fa-map-marker-alt"></i>
                                                {{ $meeting->rooms->room_name }}</span>
                                        </div>
                                    </td>
                                    @php
                                    $now = \Carbon\Carbon::now();
                                    $startTime = \Carbon\Carbon::parse($meeting->start_time);
                                    $endTime = \Carbon\Carbon::parse($meeting->end_time);
                                    @endphp

                                    <td>
                                        @if ($now->gte($startTime) && $now->lt($endTime))
                                        <span class="badge badge-success">Rapat Dimulai</span>
                                        @elseif ($now->gte($endTime))
                                        <span class="badge badge-primary">Selesai</span>
                                        @else
                                        <span class="badge badge-danger">{{ $meeting->status }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="primary-btn">
                                            <a class="btn btn-success"
                                                href="{{ route('users-meetings.detailscheduleuser', $meeting->meeting_id) }}">Read
                                                More</a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach

                                <!-- Tampilkan pagination untuk tab "Meeting In Day" -->


                            </tbody>
                            @else

                            @endif
                        </table>
                        <p>No meetings available for today.</p>
                        {{-- {{ $meetingsInDay->appends(['tab' => 'one'])->links('pagination::bootstrap-4', ['class' => 'custom-pagination']) }}
                        --}}


                    </div>
                </div>





                <div class="tab-pane fade {{ $activeTab == 'two' ? 'active show' : '' }}" id="profile" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table" id="profiles">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center" scope="col">Tanggal</th>
                                    <th scope="col">Pimpinan Rapat</th>
                                    <th scope="col">Informasi Rapat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ruangan</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($meetingsAllDay->count() > 0)
                                @foreach ($meetingsAllDay as $meeting)

                                <tr class="inner-box">
                                    <th scope="row">
                                        <div class="event-date">
                                            <span>{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('d') }}</span>
                                            <p>{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('F') }}
                                            </p>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="event-img">
                                            <img src="{{ asset('img/'.$meeting->leader->image) }}" alt="" />
                                        </div>

                                    </td>
                                    <td>
                                        <div class="event-wrap">
                                            <h3><a href="#">{{ $meeting->meeting_theme }} </a></h3>
                                            <div class="meta">
                                                <div class="organizers">
                                                    <a href="#">{{ $meeting->leader->name }}</a>
                                                </div>

                                                <div class="time">
                                                    <span><i class="far fa-clock"></i>
                                                        {{ $meeting->start_time->format('H:i') }} -
                                                        {{ $meeting->end_time->format('H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    @php
                                    $now = \Carbon\Carbon::now();
                                    $startTime = \Carbon\Carbon::parse($meeting->start_time);
                                    $endTime = \Carbon\Carbon::parse($meeting->end_time);
                                    @endphp

                                    <td>
                                        @if ($now->gte($startTime) && $now->lt($endTime))
                                        <span class="badge badge-success">Rapat Dimulai</span>
                                        @elseif ($now->gte($endTime))
                                        <span class="badge badge-primary">Selesai</span>
                                        @else
                                        <span class="badge badge-danger">{{ $meeting->status }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="r-no">
                                            <span><i class="fas fa-map-marker-alt"></i>
                                                {{ $meeting->rooms->room_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="primary-btn">
                                            <a class="btn btn-success"
                                                href="{{ route('users-meetings.detailscheduleuser', $meeting->meeting_id) }}">Read
                                                More</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                            @else

                            <p>No meetings available for today.</p>
                            @endif
                        </table>

                        {{-- {{ $meetingsAllDay->appends(['tab' => 'two'])->links('pagination::bootstrap-4', ['class' => 'custom-pagination']) }}
                        --}}
                    </div>
                </div>



            </div>

        </div>
        <!-- /col end-->
    </div>
    <!-- /row end-->
</div>





<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#homes').DataTable();
    });


    $(document).ready(function () {
        $('#profiles').DataTable();
    });
</script>


@endsection
