{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@include('layouts_auth.h_auth')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div>
                  <img src="{{ asset('template/images/logo_db.png') }}" alt="logo" width="230px">
                </div>
<h4>Forgot your password?</h4>
<h6 class="font-weight-light"> No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
</h6>
<form class="pt-3" method="POST" action="{{ route('password.email') }}">
    @csrf
  <div class="form-group">
    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
    @error('email')
    <div class=" text-danger">{{ $message }}</div>
@enderror
</div>

  <div class="mt-3">
    <button type="submit" class="btn btn-block btn-susccess btn-lg font-weight-medium auth-form-btn" >Email Password Reset Link</button>

</div>

</form>
</div>
</div>
</div>
</div>
</div>

</div>

</div>

@include('layouts_auth.f_auth')
