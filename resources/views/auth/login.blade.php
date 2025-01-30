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
                                            id="exampleInputEmail" placeholder="Email" name="email">
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
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        style="width: 100%; background-color: #45ACE8FF; border-color: #45ACE8FF;"
                                        type="submit">LOGIN</button>
                                </div>
                                


                            </form>
                            @endsection
