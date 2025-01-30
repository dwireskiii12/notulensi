@include('layouts_auth.h_auth')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
        <div class="content-wrapper auth auth-img-bg d-flex align-items-center justify-content-center">
            <div class="row w-100">
                <div class="col-lg-6 mx-auto">
                    <div class="auth-form-transparent text-center p-3">
                        <div>
                            <img src="{{ asset('template/images/Sirapat.png') }}" alt="logo" width="180px">
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts_auth.f_auth')
