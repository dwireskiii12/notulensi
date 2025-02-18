@extends('layouts_auth.auth')
@section('content')
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += '{{ $error }}<br>';
        @endforeach

        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: errorMessages,
            confirmButtonColor: '#45ACE8FF',
        });
    });
</script>
@endif
<h4>Welcome back!</h4>
<h6 class="font-weight-light">Happy to see you again!</h6>
<form class="pt-3" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail" class="text-start font-weight-bold d-block">Email</label>
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                    <i class="mdi mdi-email text-primary"></i>
                </span>
            </div>
            <input type="email" class="form-control form-control-lg border-left-0"
                id="exampleInputEmail" placeholder="Email" name="email" required>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword" class="text-start font-weight-bold d-block">Password</label>
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                    <i class="mdi mdi-lock-outline text-primary"></i>
                </span>
            </div>
            <input type="password" class="form-control form-control-lg border-left-0"
                id="exampleInputPassword" placeholder="Password" name="password"
                required autocomplete="current-password">
        </div>
    </div>
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input" name="remember">
                Keep me signed in
            </label>
        </div>
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
        @endif
    </div>

    <div class="my-3">
        <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn"
            style="width: 100%; background-color: #45ACE8FF; border-color: #45ACE8FF; transition: background-color 0.3s;"
            type="submit">LOGIN</button>
    </div>
</form>
<style>
    /* Hover effect for button */
    .auth-form-btn:hover {
        background-color: #3180C5FF;
        border-color: #3180C5FF;
    }

    /* Smooth transition for input focus */
    .form-control:focus {
        border-color: #45ACE8FF;
        box-shadow: 0 0 5px rgba(69, 172, 232, 0.8);
    }

    /* Adding subtle animation on form load */
    form {
        animation: slideIn 0.5s ease-in-out;
    }

    @keyframes slideIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .input-group-text {
        transition: transform 0.3s ease;
    }

    .input-group-text:hover {
        transform: scale(1.2);
    }
</style>

@endsection
