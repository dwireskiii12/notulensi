<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <ul class="navbar-nav navbar-nav-left">
                    <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                        {{-- <a href="" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a> --}}
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                            id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell mx-4"></i>
                            <span class="count bg-success">{{ $status->where('end_time', '>=', now())->count() }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            @foreach ($status->where('end_time', '>=', now())  as $sts)
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <img src="{{ asset('img/'. $sts->leader->image) }}" alt="image"
                                        class="profile-pic">
                                        {{-- <i class="mdi mdi-account-box mx-0"></i> --}}
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">{{ $sts->meeting_theme }}</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        {{ $sts->status }} - {{ $sts->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="mdi mdi-email mx-0"></i>
                            <span class="count bg-primary">{{ isset($meetingsss) ? $meetingsss->count() : 0 }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                            @if(isset($meetingsss))
                            @foreach($meetingsss as $meeting)
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('img/'. $meeting->leader->image) }}" alt="image"
                                        class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-normal">{{ $meeting->leader->name }}
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        {{ $meeting->meeting_theme }}
                                    </p>
                                    <p class="font-weight-light small-text text-muted mb-0">

                                        {{ \Carbon\Carbon::parse($meeting->start_time)->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </a>
                            @endforeach
                            @else
                            <p class="font-weight-light small-text text-muted mb-0 p-2">No meetings available</p>
                            @endif
                        </div>
                    </li>
                    {{-- @if(Auth::check())
                      <li class="nav-item dropdown">
                          <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                              <i class="mdi mdi-bell mx-0"></i>
                              <span class="count bg-danger">{{ Auth::user()->meetings->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="notificationDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                        @foreach(Auth::user()->meetings as $notification)
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-alert-circle-outline mx-0"></i>
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject font-weight-normal">{{ $notification->data['title'] }}</h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    {{ $notification->data['message'] }}
                                </p>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    </li>
                    @endif --}}


                    {{-- <li class="nav-item dropdown">
                        <a href="#" class="nav-link count-indicator "><i class="mdi mdi-message-reply-text"></i></a>
                      </li> --}}
                    <li class="nav-item nav-search d-none d-lg-block ms-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="search">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="search" aria-label="search"
                                aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <div class="text-center      d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo m-2" href="#"><img src="{{ asset('template/images/logo_db.png') }}" width="130px"
                            alt="logo" /></a>
                    {{-- <a class="navbar-brand brand-logo-mini" href="#"><img
                            src="{{ asset('template/images/logo-mini.svg') }}" alt="logo" /></a> --}}
                </div>
                <ul class="navbar-nav navbar-nav-right">

                    {{-- <li class="nav-item dropdown d-lg-flex d-none">
                          <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-bs-toggle="dropdown">
                          Reports
                          </a>
                          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
                              <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>
                              <a class="dropdown-item">
                                <i class="mdi mdi-file-pdf text-primary"></i>
                                Pdf
                              </a>
                              <a class="dropdown-item">
                                <i class="mdi mdi-file-excel text-primary"></i>
                                Exel
                              </a>
                          </div>
                        </li> --}}
                    <li class="nav-item dropdown d-lg-flex d-none">
                        <a href="{{ url('profile') }}" class="btn btn-inverse-success btn-sm">
                            <i class="mdi mdi-settings
 box-icon"></i>
                            Settings</a>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                            <span class="online-status"></span>
                            <img src="{{ asset('img/'. Auth::user()->image) }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="mdi mdi-settings text-primary"></i>
                                Settings
                            </a>

                            <!-- Authentication -->
                            {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button data-toggle="modal" data-target="#logout" class="dropdown-item"><i
                                    class="mdi mdi-logout text-primary"></i>Logout</button>
                            </form> --}}


                            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="button" id="logoutButton" class="dropdown-item">
                                    <i class="mdi mdi-logout text-primary"></i> Logout
                                </button>
                            </form>

                            <script>
                                // Menangani klik tombol logout
                                document.getElementById('logoutButton').addEventListener('click', function () {
                                    // Tampilkan pesan konfirmasi SweetAlert
                                    Swal.fire({
                                        title: 'Konfirmasi',
                                        text: 'Anda yakin ingin logout?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes!',
                                        cancelButtonText: 'No'
                                    }).then((result) => {
                                        // Jika pengguna mengklik "Ya", submit formulir logout
                                        if (result.isConfirmed) {
                                            document.getElementById('logoutForm').submit();
                                        }
                                    });
                                });
                            </script>
                        </div>

                    </li>



                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none d-md-none align-self-center" type="button"
                    data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </div>



    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                @if(Auth::check())
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">

                    <a class="nav-link" href="{{ url('dashboard') }}">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->role == 1)
                <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('users') }}">
                        <i class="mdi mdi-account-multiple-plus
     menu-icon"></i>
                        <span class="menu-title">Data Pegawai</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('fas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('fas') }}">
                        <i class="mdi mdi-laptop-chromebook
 menu-icon"></i>
                        <span class="menu-title">Data Fasilitas Rapat</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('rooms') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('rooms') }}">
                        <i class="mdi mdi-home-map-marker menu-icon"></i>
                        <span class="menu-title">Data Ruang Rapat</span>
                    </a>
                </li>



                @endif

                @if(Auth::user()->role == 2)



                <li class="nav-item {{ Request::is('meeting') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('meeting') }}">
                        <i class="mdi mdi-calendar-plus menu-icon"></i>
                        <span class="menu-title">Pengajuan Rapat</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('meeting-schedule') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('meeting-schedule') }}">
                        <i class="mdi mdi-calendar-multiple-check
 menu-icon"></i>
                        <span class="menu-title">Jadwal Rapat</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('meeting-result') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('meeting-result') }}">
                        <i class="mdi mdi-book-open menu-icon"></i>
                        <span class="menu-title">Data Hasil Rapat</span>
                    </a>
                </li>
                @endif


                @if(Auth::user()->role == 3)


                <li class="nav-item {{ Request::is('conclution-meetings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('conclution-meetings') }}">
                        <i class="mdi mdi-pen menu-icon"></i>
                        <span class="menu-title">Data Penyimpulan Rapat</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 4)


                <li class="nav-item {{ Request::is('users-meetings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('users-meetings') }}">
                        <i class="mdi mdi-calendar-clock
 menu-icon"></i>
                        <span class="menu-title">Data Agenda Rapat</span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('users-result-meetings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('users-result-meetings') }}">
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                        <span class="menu-title">Data Hasil Rapat</span>
                    </a>
                </li>

                @endif
                @endif
            </ul>
        </div>
    </nav>
</div>
