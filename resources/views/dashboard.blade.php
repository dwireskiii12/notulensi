@extends('layouts.index')

@section('content')


{{-- role admin =============================================================================================================== --}}
@if(Auth::user()->role == 1)


<div class="row">
    <div class="col-sm-6 mb-4 mb-xl-0">
        <div class="d-lg-flex align-items-center">
            <div>
                <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back {{ Auth::user()->name }}!</h3>
                {{-- <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6> --}}
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="d-flex align-items-center justify-content-md-end">

            <div class="pe-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRighta" aria-controls="offcanvasRight">
                    Help
                    <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRighta" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                  <h5 id="offcanvasRightLabel">Penggunaan Menu Admin</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h2>Penjelasan Menu Admin</h2>

                    <h3>Dashboard</h3>
                    <p>Dashboard adalah halaman utama yang memberikan ringkasan atau gambaran umum tentang aktivitas dan informasi penting yang berkaitan dengan manajemen rapat dan operasional perusahaan. Di sini, admin dapat melihat statistik penting, pemberitahuan, dan informasi terbaru.</p>

                    <h3>Data Pegawai</h3>
                    <p>Data Pegawai menampilkan daftar semua pegawai yang terdaftar dalam sistem. Admin dapat mengelola data pegawai, termasuk menambah pegawai baru, mengedit informasi pegawai yang ada, dan menghapus pegawai yang sudah tidak aktif.</p>

                    <h3>Data Fasilitas Rapat</h3>
                    <p>Data Fasilitas Rapat mencakup semua fasilitas yang tersedia untuk rapat, seperti proyektor, laptop, papan tulis, dan peralatan lainnya. Admin dapat mengelola fasilitas ini, memastikan ketersediaannya, dan mengupdate informasi fasilitas jika diperlukan.</p>

                    <h3>Data Ruangan Rapat</h3>
                    <p>Data Ruangan Rapat mencakup semua ruangan yang tersedia untuk digunakan sebagai tempat rapat. Admin dapat mengelola informasi ruangan, termasuk menambah ruangan baru, mengedit detail ruangan yang ada, dan menghapus ruangan yang sudah tidak tersedia. Admin juga bisa melihat jadwal pemakaian ruangan untuk mengatur penggunaan yang efisien.</p>

                    <p><strong>Catatan:</strong> Pastikan semua data yang dikelola di dalam menu ini selalu diperbarui agar informasi yang tersedia akurat dan dapat diandalkan.</p>
                </div>
              </div>

        </div>
    </div>
</div>



<div class="row mt-4">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">

               {{-- rapat perbulan --}}
                    <div class="col-lg-4">
                        <h4 class="card-title">Meetings per Month</h4>
                        <canvas id="meetingsPerMonthChart"></canvas>
                        {{-- <p class="mt-3 mb-4 mb-lg-0">Lorem ipsum dolor sit amet,
                            consectetur adipisicing elit.
                        </p> --}}
                    </div>
                {{-- end rapat perbulan --}}


                 {{-- ruangan top perbulan --}}
                    <div class="col-lg-5">
                        <h4 class="card-title">Top Use In Rooms</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="graphl-legend-rectangle">
                                    @foreach($chartData['labels'] as $index => $label)
                                    <li>
                                        <span class="legend-box"
                                            style="background-color: {{ $chartData['datasets'][0]['backgroundColor'][$index] }}"></span>
                                        {{ $label }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-8 grid-margin">
                                <canvas id="roomUsageChart"></canvas>
                            </div>
                        </div>
                        {{-- <p class="mt-3 mb-4 mb-lg-0">orem ipsum dolor sit amet,
                            consectetur adipisicing elit.
                        </p> --}}
                    </div>
                 {{-- end ruangan top perbulan --}}


    {{-- fasilitas top perbulan --}}
 <div class="col-lg-3">
    <h4 class="card-title">Meeting Facilities Statistics</h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="progress progress-lg grouped mb-2">
                @php
                     $total = array_sum($facility['datasets'][0]['data']);
                @endphp
                @foreach($facility['datasets'][0]['data'] as $index => $data)
                    @php
                         $percentage = ($data / $total) * 100;
                     @endphp
                <div class="progress-bar" style="background-color: {{ $facility['datasets'][0]['backgroundColor'][$index] }};
                            width: {{ $percentage }}%;" role="progressbar" aria-valuenow="{{ $data }}"
                    aria-valuemin="0" aria-valuemax="{{ $total }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-sm-12">
            <ul class="graphl-legend-rectangle">
                @php
                     $total = array_sum($facility['datasets'][0]['data']);
                @endphp
                @foreach($facility['labels'] as $index => $label)
                @php
                   $data = $facility['datasets'][0]['data'][$index];
                   $percentage = ($data / $total) * 100;
                @endphp
                <li>
                    <span class="legend-box"
                        style="background-color: {{ $facility['datasets'][0]['backgroundColor'][$index] }}"></span>
                    {{ $label }} ( {{ number_format($percentage, 1) }}%)
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{-- <p class="mb-0 mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> --}}
</div>


      {{-- end fasilitas top perbulan --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card congratulation-bg">
            <div class="card-body text-center">
                <img src="{{ asset('img/'. Auth::user()->image) }}" alt="" height="150px">
                <h2 class="mt-3 text-white mb-3 font-weight-bold">{{ Auth::user()->name }}

                </h2>
                <p>
@if (Auth::user()->role == 1)
Admin
    @elseif (Auth::user()->role == 2)
    Sekretaris
    @elseif (Auth::user()->role == 3)
    Notulensi
    @else
    User
@endif
                </p>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <!-- Kolom Kiri dengan 1 Baris -->
        <div class="card" style="height: 475px;">
            <div class="card-body">
                <h4 class="card-title mb-2">Kalender Jadwal Rapat</h4>
                <div id="calendar"  ></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="row">
        <div class="md-4">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Orders Received</h6>
                    <h2 class="text-right">{{ $people }}<i class="mdi mdi-account-multiple f-right"></i></h2>
                    <p class="m-b-0">Data Peserta Aktif<span class="f-right"></span></p>

                </div>
            </div>
        </div>
        <div class="md-4 ">
            <div class="card bg-c-yellow order-card mt-4" >
                <div class="card-block">
                    <h6 class="m-b-20">Data Ruangan</h6>
                    <h2 class="text-right"><i class="mdi mdi-laptop-mac f-right"></i>{{ $room }}</h2>
                    <p class="m-b-0">Ruangan Aktif<span class="f-right"></span></p>

                </div>
            </div>
        </div>

        <div class="md-4 ">
            <div class="card bg-c-blue order-card mt-4">
                <div class="card-block">
                    <h6 class="m-b-20">Data Fasilitas Rapat</h6>
                    <h2 class="text-right"><i class="mdi mdi-home-map-marker f-right"></i>{{ $fas }}</h2>
                    <p class="m-b-0">Fasilitas Rapat Yang Tersedia<span class="f-right"></span></p>

                </div>
            </div>
        </div>


	</div>
</div>
        <!-- Kolom Kanan dengan 3 Baris -->

    </div>
</div>







@endif

{{-- role sekertaris =============================================================================================================== --}}
@if(Auth::user()->role == 2)

<div class="row">
    <div class="col-sm-6 mb-4 mb-xl-0">
        <div class="d-lg-flex align-items-center">
            <div>
                <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back {{ Auth::user()->name }}!</h3>
                {{-- <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6> --}}
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="d-flex align-items-center justify-content-md-end">

            <div class="pe-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightss" aria-controls="offcanvasRight">
                    Help
                    <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                </button>
            </div>


            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightss" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                  <h5 id="offcanvasRightLabel">Penggunaan Menu Sekertaris</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h2>Penjelasan Menu Sekretaris</h2>

                    <h3>Dashboard</h3>
                    <p>Dashboard adalah halaman utama yang memberikan ringkasan atau gambaran umum tentang aktivitas dan informasi penting terkait rapat yang sedang atau akan dijadwalkan.</p>

                    <h3>Pengajuan Rapat</h3>
                    <p>Pengajuan Rapat adalah fitur untuk mengatur dan mengajukan rapat baru. Dalam menu ini, terdapat empat tombol aksi:</p>
                    <ul>
                        <li><strong>Jadwalkan Rapat:</strong> Untuk menjadwalkan rapat baru.</li>
                        <li><strong>Edit:</strong> Untuk mengedit detail rapat yang sudah diajukan.</li>
                        <li><strong>Cancel:</strong> Untuk membatalkan rapat yang sudah diajukan.</li>
                        <li><strong>Submit:</strong> Untuk mengajukan rapat yang sudah dijadwalkan.</li>
                    </ul>
                    <p>Setelah rapat diajukan dengan menekan tombol <strong>Submit</strong>, status rapat akan berubah menjadi <strong>Menunggu Dimulai</strong>. Jika ingin memulai rapat, tekan tombol <strong>Submit</strong> sekali lagi, undangan rapat akan dikirim ke email peserta, dan status rapat akan tetap <strong>Menunggu Dimulai</strong> hingga rapat benar-benar dimulai.</p>

                    <h3>Jadwal Rapat</h3>
                    <p>Jadwal Rapat menampilkan semua rapat yang telah dijadwalkan, baik yang sudah diajukan maupun yang sedang menunggu untuk dimulai. Ini membantu sekretaris untuk memantau semua jadwal rapat yang akan datang.</p>

                    <h3>Data Hasil Rapat</h3>
                    <p>Data Hasil Rapat menyediakan informasi mengenai hasil-hasil dari rapat yang telah dilaksanakan, termasuk kesimpulan rapat, catatan penting, atau dokumen-dokumen terkait hasil rapat.</p>

                    <p><strong>Catatan:</strong> Pastikan untuk selalu memperbarui status dan informasi rapat dengan tepat agar semua peserta mendapatkan informasi yang akurat dan terkini.</p>
                </div>
              </div>

        </div>
    </div>
</div>



{{-- kontent --}}


<div class="row mt-2">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">



                 {{-- ruangan top perbulan --}}
                    <div class="col-lg-5">
                        <h4 class="card-title">Top Use In Rooms</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="graphl-legend-rectangle">
                                    @foreach($chartData['labels'] as $index => $label)
                                    <li>
                                        <span class="legend-box"
                                            style="background-color: {{ $chartData['datasets'][0]['backgroundColor'][$index] }}"></span>
                                        {{ $label }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-8 grid-margin">
                                <canvas id="roomUsageChart"></canvas>
                            </div>
                        </div>
                        {{-- <p class="mt-3 mb-4 mb-lg-0">orem ipsum dolor sit amet,
                            consectetur adipisicing elit.
                        </p> --}}

                    </div>
                 {{-- end ruangan top perbulan --}}


    {{-- fasilitas top perbulan --}}





 <div class="col-lg-3">
    <h4 class="card-title">Meeting Facilities Statistics</h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="progress progress-lg grouped mb-2">
                @php
                     $total = array_sum($facility['datasets'][0]['data']);
                @endphp
                @foreach($facility['datasets'][0]['data'] as $index => $data)
                    @php
                         $percentage = ($data / $total) * 100;
                     @endphp
                <div class="progress-bar" style="background-color: {{ $facility['datasets'][0]['backgroundColor'][$index] }};
                            width: {{ $percentage }}%;" role="progressbar" aria-valuenow="{{ $data }}"
                    aria-valuemin="0" aria-valuemax="{{ $total }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-sm-12">
            <ul class="graphl-legend-rectangle">
                @php
                     $total = array_sum($facility['datasets'][0]['data']);
                @endphp
                @foreach($facility['labels'] as $index => $label)
                @php
                   $data = $facility['datasets'][0]['data'][$index];
                   $percentage = ($data / $total) * 100;
                @endphp
                <li>
                    <span class="legend-box"
                        style="background-color: {{ $facility['datasets'][0]['backgroundColor'][$index] }}"></span>
                    {{ $label }} ( {{ number_format($percentage, 1) }}%)
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{-- <p class="mb-0 mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> --}}
</div>


      {{-- end fasilitas top perbulan --}}
 {{-- rapat perbulan --}}
 <div class="col-lg-4">
    <h4 class="card-title">Meetings per Month</h4>
    <canvas id="meetingsPerMonthChart"></canvas>
    {{-- <p class="mt-3 mb-4 mb-lg-0">Lorem ipsum dolor sit amet,
        consectetur adipisicing elit.
    </p> --}}
</div>
{{-- end rapat perbulan --}}




                </div>
            </div>
        </div>
    </div>




    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card congratulation-bg">
            <div class="card-body text-center">
                <img src="{{ asset('img/'. Auth::user()->image) }}" alt="" height="150px">
                <h2 class="mt-3 text-white mb-3 font-weight-bold">{{ Auth::user()->name }}

                </h2>
                <p>
@if (Auth::user()->role == 1)
Admin
    @elseif (Auth::user()->role == 2)
    Sekretaris
    @elseif (Auth::user()->role == 3)
    Notulensi
    @else
    User
@endif
                </p>
            </div>
        </div>
    </div>

</div>




<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <!-- Kolom Kiri dengan 1 Baris -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">Kalender Jadwal Rapat</h4>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="row">
        <div class="md-4 ">
            <div class="card bg-c-blue order-card ">
                <div class="card-block">
                    <h6 class="m-b-20">Data Pengajuan Rapat</h6>
                    <h2 class="text-right"><i class="mdi mdi-calendar-plus f-right"></i>{{ $waiting }}</h2>
                    <p class="m-b-0">Status Menunggu Diajukan<span class="f-right"></span></p>

                </div>
            </div>
        </div>





        <div class="md-4">
            <div class="card bg-c-pink order-card mt-4">
                <div class="card-block">
                    <h6 class="m-b-20">Data Jadwal Rapat</h6>
                    <h2 class="text-right">{{ $schedule }}<i class="mdi mdi-calendar-multiple-check f-right"></i></h2>
                    <p class="m-b-0">Status Meunggu Dimulai<span class="f-right"></span></p>

                </div>
            </div>
        </div>

        <div class="md-4 ">
            <div class="card bg-c-yellow order-card mt-4" >
                <div class="card-block">
                    <h6 class="m-b-20">Data Hasil Rapat</h6>
                    <h2 class="text-right"><i class="mdi mdi-book-open f-right"></i>{{ $ends }}</h2>
                    <p class="m-b-0">Status Rapat Selesai<span class="f-right"></span></p>

                </div>
            </div>
        </div>




	</div>
</div>
        <!-- Kolom Kanan dengan 3 Baris -->

    </div>
</div>





@endif

{{-- role notulensi =============================================================================================================== --}}
@if(Auth::user()->role == 3)

<div class="row">
    <div class="col-sm-6 mb-4 mb-xl-0">
        <div class="d-lg-flex align-items-center">
            <div>
                <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back {{ Auth::user()->name }}!</h3>
                {{-- <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6> --}}
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="d-flex align-items-center justify-content-md-end">







            <div class="pe-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRights" aria-controls="offcanvasRight">
                    Help
                    <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                </button>
            </div>


            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRights" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                  <h5 id="offcanvasRightLabel">Informasi Pengunaan</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h2>Penjelasan Menu Notulensi Rapat</h2>

    <h3>Dashboard</h3>
    <p>Dashboard adalah halaman utama yang memberikan ringkasan atau gambaran umum tentang notulensi rapat yang Anda kelola.</p>

    <h3>Data Penyimpulan Rapat</h3>
    <p>Data Penyimpulan Rapat terbagi menjadi:</p>
    <ul>
        <li><strong>Status Private:</strong> Hanya notulis yang dapat melihat hasil kesimpulan rapat.</li>
        <li><strong>Status Public:</strong> Seluruh peserta rapat dapat melihat hasil kesimpulan rapat.</li>
    </ul>

    <h3>Tombol Aksi</h3>
    <p>Untuk setiap entri dalam Data Penyimpulan Rapat, terdapat beberapa tombol aksi:</p>
    <ul>
        <li><strong>Input Kesimpulan:</strong> Untuk menambahkan atau memasukkan kesimpulan rapat.</li>
        <li><strong>Edit Kesimpulan:</strong> Untuk mengubah atau memperbarui kesimpulan rapat yang sudah ada.</li>
        <li><strong>Detail:</strong> Untuk melihat detail lengkap dari kesimpulan rapat.</li>
        <li><strong>Save:</strong> Untuk menyimpan perubahan atau kesimpulan yang telah dimasukkan atau diubah.</li>
        <li><strong>Public:</strong> Untuk mengubah status kesimpulan rapat menjadi public, sehingga dapat diakses oleh seluruh peserta rapat.</li>
    </ul>

    <p><strong>Catatan:</strong> Pastikan untuk mengatur ulang kata sandi yang telah diberikan melaui email serta lakukan  pengaturan status private atau public dengan hati-hati sesuai kebutuhan dan kebijakan rapat.</p>
                </div>
              </div>

        </div>
    </div>
</div>




<div class="row mt-2">
    <div class="col-lg-8 grid-margin stretch-card">
        <!-- Kolom Kiri dengan 1 Baris -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">Kalender Jadwal Rapat</h4>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="row">
        <div class="md-4 ">
            <div class="card bg-c-blue order-card ">
                <div class="card-block">
                    <h6 class="m-b-20">Data Rapat Belum Ada Kesimpulan</h6>
                    <h2 class="text-right"><i class="mdi mdi-pen f-right"></i>{{ $countNoConclusion }}</h2>
                    <p class="m-b-0">Status Menunggu Kesimpulan<span class="f-right"></span></p>

                </div>
            </div>
        </div>

        <div class="md-4">
            <div class="card bg-c-pink order-card mt-4">
                <div class="card-block">
                    <h6 class="m-b-20">Data Rapat Sudah Disimpulkan</h6>
                    <h2 class="text-right">{{ $countPrivate }}<i class="mdi mdi-pencil-lock f-right"></i></h2>
                    <p class="m-b-0">Status Kesimpulan Masih PRIVATE<span class="f-right"></span></p>

                </div>
            </div>
        </div>

        <div class="md-4 ">
            <div class="card bg-c-yellow order-card mt-4" >
                <div class="card-block">
                    <h6 class="m-b-20">Data Hasil  Rapat</h6>
                    <h2 class="text-right"><i class="mdi mdi-spellcheck
 f-right"></i>{{ $countPublic }}</h2>
                    <p class="m-b-0">Status Hasil Rapat PUBLIC<span class="f-right"></span></p>

                </div>
            </div>
        </div>
	</div>
</div>
        <!-- Kolom Kanan dengan 3 Baris -->

    </div>
</div>






                </div>
            </div>
        </div>
    </div>

@endif


{{-- role user =============================================================================================================== --}}
@if(Auth::user()->role == 4)

<div class="row">
    <div class="col-sm-6 mb-4 mb-xl-0">
        <div class="d-lg-flex align-items-center">
            <div>
                <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back {{ Auth::user()->name }}!</h3>
                {{-- <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6> --}}
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="d-flex align-items-center justify-content-md-end">


            <div class="pe-1  mb-xl-0">
                <button type="button" class="btn btn-outline-inverse-info btn-icon-text" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightu" aria-controls="offcanvasRight">
                    Help
                    <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                </button>
            </div>


            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightu" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                  <h5 id="offcanvasRightLabel">Penggunaan Menu Peserta</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h2>Penjelasan Menu Peserta</h2>

                    <h3>Dashboard</h3>
                    <p>Dashboard adalah halaman utama yang memberikan ringkasan atau gambaran umum tentang aktivitas dan informasi penting terkait rapat peserta (user) saat ini.</p>

                    <h3>Data Agenda Rapat</h3>
                    <p>Data Agenda Rapat terbagi menjadi dua bagian:</p>
                    <ul>
                        <li><strong>In Day:</strong> Menampilkan daftar rapat yang dijadwalkan pada hari ini.</li>
                        <li><strong>All Day:</strong> Menampilkan semua jadwal rapat yang telah dijadwalkan untuk waktu tertentu.</li>
                    </ul>

                    <h3>Data Hasil Rapat</h3>
                    <p>Data Hasil Rapat menyediakan informasi mengenai hasil-hasil dari rapat yang telah dilaksanakan, termasuk kesimpulan rapat, atau catatan penting terkait hasil rapat.</p>

                    <p><strong>Catatan:</strong>Anda dapat memantau hasil rapat melaui email anda yang terdaftar disistem kami, namun untuk melihat jelas terkait informasi rapat anda dapat login ke sistem kami.</p>
                </div>
              </div>

        </div>
    </div>
</div>




<div class="row mt-2">
    <div class="col-lg-8 grid-margin stretch-card">
        <!-- Kolom Kiri dengan 1 Baris -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">Kalender Jadwal Rapat</h4>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="row">
        <div class="md-4 ">
            <div class="card bg-c-blue order-card ">
                <div class="card-block">
                    {{-- <h6 class="m-b-20">Jadwal Rapat Hari Ini</h6> --}}
                    <h2 class="text-right"><i class="mdi mdi-calendar-clock f-right"></i>{{ $meetingsInDay }}</h2>
                    <p class="m-b-0">Jadwal Rapat Hari Ini<span class="f-right"></span></p>

                </div>
            </div>
        </div>

        <div class="md-4">
            <div class="card bg-c-pink order-card mt-4">
                <div class="card-block">
                    {{-- <h6 class="m-b-20">Data Rapat Sudah Disimpulkan</h6> --}}
                    <h2 class="text-right">{{ $meetingsAllDay }}<i class="mdi mdi-chart-areaspline f-right"></i></h2>
                    <p class="m-b-0">Riwayat Rapat<span class="f-right"></span></p>

                </div>
            </div>
        </div>


	</div>
</div>
        <!-- Kolom Kanan dengan 3 Baris -->

    </div>
</div>






                </div>
            </div>
        </div>
    </div>

@endif



{{-- chart js --}}
{{-- chart fulcalender agenda per user  =============================================================================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        events: {!! json_encode($events) !!},
        locale: 'id',
        timezone: 'Asia/Singapore',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay', // Tampilan yang tersedia
        },



         // Mengatur zona waktu ke PALU
        eventDidMount: function(info) {
            // Menyesuaikan format tanggal dan waktu
            var startDate = info.event.start.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
            var startTime = info.event.start.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            var endTime = info.event.end.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            // Menambahkan tooltip untuk menampilkan judul, tanggal, jam mulai, dan jam selesai saat hover
            var tooltip = new bootstrap.Tooltip(info.el, {
                title: `
                    <strong>${info.event.title}</strong><br>
                    Tanggal: ${startDate}<br>
                    Jam Mulai: ${startTime} WITA <br>
                    Jam Selesai: ${endTime} WITA
                `,
                placement: 'top',
                trigger: 'hover',
                container: 'body',
                html: true // Aktifkan opsi HTML untuk memungkinkan tag HTML dalam tooltip
            });

            // Memeriksa panjang judul dan mempersingkat jika terlalu panjang
            if (info.event.title.length > 10) {
                info.el.querySelector('.fc-event-title').textContent = info.event.title.substring(0, 10) + '...';
            }
        }
    });

    calendar.render();



    // Fungsi untuk menangani klik tombol "Month"
    document.getElementById('btnMonthView').addEventListener('click', function() {
        calendar.changeView('dayGridMonth');
        // Pastikan Anda menambahkan kembali event listener atau logika lainnya di sini
    });

    // Fungsi untuk menangani klik tombol "Week"
    document.getElementById('btnWeekView').addEventListener('click', function() {
        calendar.changeView('timeGridWeek');
        // Pastikan Anda menambahkan kembali event listener atau logika lainnya di sini
    });
});

</script>

{{-- chart agenda rapat terbanyak perbulan  =============================================================================================================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        var pieChartCanvas = $("#roomUsageChart").get(0).getContext("2d");

        var roomUsageData = @json($chartData);

        var roomUsageOptions = {
            responsive: true,
            cutoutPercentage: 80,
            legend: {
                display: false,
            },
            tooltips: {
                enabled: true,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return `${data.labels[tooltipItem.index]}: ${percentage}%`;
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            plugins: {
                datalabels: {
                    display: false,
                }
            }
        };

        if ($("#roomUsageChart").length) {
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: roomUsageData,
                options: roomUsageOptions
            });
        }
    });
</script>



{{-- chart agenda rapat terbanyak perbulan  =============================================================================================================== --}}
<script>
    $(document).ready(function() {
        var meetingsPerMonthCanvas = $("#meetingsPerMonthChart").get(0).getContext("2d");

        var meetingsPerMonthData = @json($meetingChartData);

        var meetingsPerMonthOptions = {
            scales: {
                xAxes: [{
                    position: 'bottom',
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: true,
                    },
                    ticks: {
                        display: false,
                        beginAtZero: true
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        drawBorder: true,
                        display: false,
                    },
                    ticks: {
                        beginAtZero: true
                    },
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true,
                mode: 'index',
                intersect: false,
                backgroundColor: 'rgba(31, 59, 179, 1)',
            },
            plugins: {
                datalabels: {
                    display: true,
                    align: 'start',
                    color: 'white',
                }
            }
        };

        if ($("#meetingsPerMonthChart").length) {
            var barChart = new Chart(meetingsPerMonthCanvas, {
                type: 'horizontalBar',
                data: meetingsPerMonthData,
                options: meetingsPerMonthOptions,
            });
        }
    });
</script>



{{-- chart Fasiltas =============================================================================================================== --}}
<script>
    $(document).ready(function() {
        var meetingFacilitiesCanvas = $("#meetingFacilitiesChart").get(0).getContext("2d");

        var meetingFacilitiesData = @json($facility);

        var meetingFacilitiesOptions = {
            scales: {
                xAxes: [{
                    display: false,
                    stacked: true,
                    gridLines: {
                        display: false
                    },
                }],
                yAxes: [{
                    stacked: true,
                    display: false,
                }]
            },
            legend: {
                display: false,
                position: "bottom"
            },
            elements: {
                point: {
                    radius: 0
                },
                plugins: {
                    datalabels: {
                        display: false,
                        align: 'center',
                        anchor: 'center'
                    }
                }
            }
        };

        if ($("#meetingFacilitiesChart").length) {
            var barChart = new Chart(meetingFacilitiesCanvas, {
                type: 'horizontalBar',
                data: meetingFacilitiesData,
                options: meetingFacilitiesOptions
            });
        }
    });
</script>
@endsection

{{-- </x-app-layout> --}}
