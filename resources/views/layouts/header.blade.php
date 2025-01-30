<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIRAPAT</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('template/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('template/images/Sirapat.png') }}" />


      {{-- yajra --}}
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
  {{-- endyajra --}}


{{-- fulcalender --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>




  <style>
     .dataTables_wrapper .dataTables_filter input {
         border: 1px solid #ddd;
         padding: 5px;
         border-radius: 4px;
         margin-bottom: 20px;
     }

     .dataTables_wrapper .dataTables_length select {
         border: 1px solid #ddd;
         padding: 5px;
         border-radius: 4px;
     }


     .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
         background: #CCDCFFFF;
         border-color: #CCDCFFFF;

     }


     .dataTables_wrapper .dataTables_paginate .paginate_button:active {
         background: #CCDCFFFF;
         color: #CCDCFFFF !important;
     }

     .form-control.custom-input {
         border-color: #cdcdd4 !important;
         /* Ubah warna border input sesuai keinginan Anda */
     }

     .form-control.custom-input:focus {
         border-color: #CCDCFFFF !important;
         /* Ubah warna border input sesuai keinginan Anda */
     }


     /* Atur tinggi dan border untuk Select2 container */
     .select2-container--default .select2-selection--single {
         height: 50px;
         border: 1px solid #cdcdd4;
         border-radius: 0;
         display: flex;
         align-items: center;
         padding-left: 8px;
     }

     .select2-container--default .select2-selection--multiple {
         height: 50px;
         border: 1px solid #cdcdd4;
         border-radius: 0;
         display: flex;
         align-items: center;
         padding-left: 8px;
     }



      .card-margin {
        margin-bottom: 1.875rem;
    }

    .card {
        border: 0;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #ffffff;
        background-clip: border-box;
        border: 1px solid #e6e4e9;
        border-radius: 8px;
    }

    .card .card-header.no-border {
        border: 0;
    }

    .card .card-header {
        background: none;
        padding: 0 0.9375rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        min-height: 50px;
    }

    .card-header:first-child {
        border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
    }

    /* Base Styles */
    /* Base Styles */
    .widget-49 .widget-49-title-wrapper {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #e8faf8;
        width: 6rem;
        /* Increased width */
        height: 6rem;
        /* Increased height */
        border-radius: 50%;
        flex-shrink: 0;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-day {
        color: #CCDCFFFF;
        font-weight: 500;
        font-size: 2rem;
        /* Adjusted font size */
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-month {
        color: #CCDCFFFF;
        line-height: 1;
        font-size: 1rem;
        /* Adjusted font size */
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
        display: flex;
        flex-direction: column;
        margin-left: 1rem;
        flex-grow: 1;
        min-width: 0;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
        color: #3c4142;
        font-size: 1rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
        color: #B1BAC5;
        font-size: 0.875rem;
    }

    .widget-49 .widget-49-meeting-points {
        font-weight: 400;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item {
        display: list-item;
        color: #727686;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
        margin-left: 0.5rem;
    }

    .widget-49 .widget-49-meeting-action {
        text-align: left;
        margin-top: 1rem;
    }

    .widget-49 .widget-49-meeting-action a {
        text-transform: uppercase;
        font-size: 0.875rem;
    }


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



    /* Media Queries for Responsiveness */

    /* Tablet Styles */
    @media (max-width: 1024px) {
        .widget-49 .widget-49-title-wrapper {
            flex-direction: row;
            align-items: center;
        }

        .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
            margin-left: 0.5rem;
            margin-top: 0;
        }

        .widget-49 .widget-49-meeting-action {
            text-align: left;
            margin-top: 0;
        }
    }

    /* Mobile Styles */
    @media (max-width: 768px) {
        .widget-49 .widget-49-title-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }

        .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
            margin-left: 0;
            margin-top: 0.5rem;
        }

        .widget-49 .widget-49-meeting-action {
            text-align: left;
        }
    }
</style>

<style>
    /* Mengubah warna latar belakang area teks Summernote */
.note-editable {
    background-color: #ffffff; /* Ubah sesuai kebutuhan */
}

/* Mengubah warna teks dalam area teks Summernote */
.note-editable p {
    color: #333333; /* Ubah sesuai kebutuhan */
}

/* Mengubah warna tombol pada toolbar Summernote */
.note-toolbar button {
    background-color: #ffffff; /* Ubah sesuai kebutuhan */
    color: #333333; /* Ubah sesuai kebutuhan */

}

</style>


    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">




<style>
#calendar {
    width: 1200px;
    height: 400px;
    max-width: 100%;
}
.fc-day-today {
    background-color: #fef5e5 !important;
    font-weight: bold;  /* Ganti dengan warna yang Anda inginkan */
}


.fc-day-sun a,
.fc-day-mon a,
.fc-day-tue a,
.fc-day-wed a,
.fc-day-thu a,
.fc-day-fri a,
.fc-day-sat a {
    color: #5a6a85 !important; /* Ganti dengan warna teks yang Anda inginkan */
    text-decoration: none !important;
}
.fc-daygrid-day-number {
    font-size:12px !important; /* Sesuaikan dengan ukuran yang diinginkan */
    color: rgba(255, 255, 255, 0.837) !important; /* Mengubah warna teks menjadi hitam */
    text-decoration: none !important;
}
.fc-body {
		background-color: #fff;
	}
/* ungu babbe9 */
.fc-scrollgrid thead {
    color: #000000
    background-color: #ffffff; /* Warna latar belakang */
    /* Properti lain sesuai kebutuhan */
}

.fc-scrollgrid tbody {
    background-color: #ffffff; /* Warna latar belakang */
    padding: 10px; /* Padding di dalam elemen thead */
    /* Properti lain sesuai kebutuhan */
}


.fc-button-primary {
    background-color: #45ACE8FF !important; /* Warna latar belakang aktif (hari ini) */
    border-color: #45ACE8FF !important; /* Warna border aktif (hari ini) */
}

.fc-button-primary:hover {
    background-color: #4975ee !important; /* Warna latar belakang saat hover (hari ini) */
    border-color: #4975ee !important; /* Warna border saat hover (hari ini) */
}


.fc th{
border: none;
border-bottom: #000000;
}

.fc td{
    border-color: #ebf1f6;
    /* height: 200px; */
    color: #45ACE8FF;

}


@media (min-width: 768px) and (max-width: 1023px) {
    .fc td{
        height: 200px; /* Larger height for tablets */
    }
}

/* Media query for laptop screens */
@media (min-width: 1024px) {
    .fc td{
        /* height: 200px; */
    }
}


.fc{
    font-family: 'roboto', sans-serif;
    font-size: 14px;
    color: #000000;
}

.fc-event {

    background-color: #ebf0ff;
    font-family: 'roboto', sans-serif;
	border-radius: 3px;
    border: none;
    /* font-size: 18px; */
	/* padding: 5px;
    height: 40px; */

	}

.fc-event-main{
    color: #CCDCFFFF !important;
    /* margin: 5px; */

}
.fc-scrollgrid.fc-scrollgrid-liquid {
    border: none; /* Remove the border of the table */
}

/* Remove all borders from the table */
.fc-scrollgrid.fc-scrollgrid-liquid,
.fc-scrollgrid.fc-scrollgrid-liquid th,
 {
    border: none !important; /* Remove all borders */
}

/* .fc-scrollgrid.fc-scrollgrid-liquid thead th {
} */

/* Add borders to date cells only */
.fc-scrollgrid.fc-scrollgrid-liquid td {
    border: 1px solid #ebf1f6;
}



</style>

<style>
.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}


.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#CCDCFFFF,#CCDCFFFF);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}
</style>




  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')


    <div class="container-scroller">




