@extends('layouts.index')

@section('content')

<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Penjadwalan Rapat</h4>
            <p class="card-description">
                {{-- <a href="{{ url('meeting-create') }}" class="btn btn-success">Jadwalkan Rapat</a> --}}
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
                <table class="table table-bordered table-hover text-center" id="schedule-table"  style="margin-top: 10px; margin-bottom: 10px;" data-vertable="ver3">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th width="200px">Judul</th>
                            <th>Notulensi Rapat</th>
                            <th>Pemimpin Rapat</th>
                            <th>Tanggal</th>
                            <th>Waktu Rapat</th>
                            <th>Peserta</th>
                            <th>Ruangan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTables akan mengisi tabel ini dengan data dari server -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
   $(document).ready(function() {
    $('#schedule-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('meeting.schedule') !!}',
            type: 'GET',
            error: function(xhr, error, code) {
                console.log('Ajax error:', xhr.responseText);
            }
        },
        columns: [
            { data: 'meeting_id', name: 'meeting_id' },
            { data: 'meeting_theme', name: 'meeting_theme' },
            { data: 'minutes', name: 'minutes.name' },
            { data: 'leader', name: 'leader.name' },
            { data: 'start_time', name: 'start_time' },
            { data: 'time_range', name: 'time_range', searchable: true },
            { data: 'participant_count', name: 'participant_count' },
            { data: 'rooms', name: 'rooms.room_name' },
            { data: 'status', name: 'status' },
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



{{--

<style>



    .limiter {
        width: 100%;
        margin: 0 auto
    }

    .container-table100 {
        width: 100%;
        min-height: 100vh;
        background: #d1d1d1;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding: 33px 30px
    }

    .wrap-table100 {
        width: 1300px
    }

    table {
        width: 100%;
        background-color: #fff
    }

    th,
    td {
        font-weight: unset;
        padding-right: 10px
    }

    .column100 {
        width: 130px;
        padding-left: 25px
    }

    .column100.column1 {
        width: 265px;
        padding-left: 42px
    }

    .row100.head th {
        padding-top: 24px;
        padding-bottom: 20px
    }

    .row100 td {
        padding-top: 18px;
        padding-bottom: 14px
    }



    .table100.ver3 tbody tr {
        border-bottom: 1px solid #e5e5e5
    }

    .table100.ver3 td {
        font-family: Montserrat-Regular;
        font-size: 14px;
        color: gray;
        line-height: 1.4
    }

    .table100.ver3 th {
        font-family: Montserrat-Medium;
        font-size: 12px;
        color: #fff;
        line-height: 1.4;
        text-transform: uppercase;
        background-color: #3c41ca
    }

    .table100.ver3 .row100:hover td {
        background-color: #fcebf5
    }

    .table100.ver3 .hov-column-ver3 {
        background-color: #fcebf5
    }

    .table100.ver3 .hov-column-head-ver3 {
        background-color: #7b88e3 !important
    }

    .table100.ver3 .row100 td:hover {
        background-color: #e03e9c;
        color: #fff
    }


</style>





<div class="table100 ver3 m-b-110 table-responsive" >
    <table data-vertable="ver3" id="tes">
        <thead>
            <tr class="row100 head">
                <th class="column100 column1" data-column="column1"></th>
                <th class="column100 column2" data-column="column2">Senin</th>
                <th class="column100 column3" data-column="column3">Selasa</th>
                <th class="column100 column4" data-column="column4">Rabu</th>
                <th class="column100 column5" data-column="column5">Kamis</th>
                <th class="column100 column6" data-column="column6">Jumat</th>
                <th class="column100 column7" data-column="column7">Sabtu</th>
                <th class="column100 column8" data-column="column8">Minggu</th>
            </tr>
        </thead>

    </table>
</div>


<script>
(function ($) {
    "use strict";
    $('.column100').on('mouseover', function () {
        var table1 = $(this).parent().parent().parent();
        var table2 = $(this).parent().parent();
        var verTable = $(table1).data('vertable') + "";
        var column = $(this).data('column') + "";
        $(table2).find("." + column).addClass('hov-column-' + verTable);
        $(table1).find(".row100.head ." + column).addClass('hov-column-head-' + verTable);
    });
    $('.column100').on('mouseout', function () {
        var table1 = $(this).parent().parent().parent();
        var table2 = $(this).parent().parent();
        var verTable = $(table1).data('vertable') + "";
        var column = $(this).data('column') + "";
        $(table2).find("." + column).removeClass('hov-column-' + verTable);
        $(table1).find(".row100.head ." + column).removeClass('hov-column-head-' + verTable);
    });
})(jQuery);
</script> --}}
