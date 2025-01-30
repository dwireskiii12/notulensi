{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}
<header>
    <h2 class="h5 font-weight-bold text-dark">
        {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-muted">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>
<form id="send-verification" method="post" action="{{ route('verification.send') }}" >
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="row">
      <div class="col">
        <div class="form-group">
            <label for="foto">Update Foto</label>
            <input type="file" class="form-control"  id="foto"  name="image" value="{{ old('image', $user->image) }}">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        <div class="row">


            <div class="col">
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" readonly type="email" class="form-control" value="{{ old('email',$user->email) }}" required autocomplete="username" email>
            @if($errors->has('email'))
                <div class="text-danger mt-2">
                    {{ $errors->first('email') }}
                </div>
            @endif
                </div>
              </div>

          <div class="col">
            <div class="form-group">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @if($errors->has('name'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
          </div>


          <div class="col">
            <div class="form-group">
                <label>Telepon</label>
                <input class="form-control" type="text" placeholder="Nomor Telepon" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
            </div>
          </div>


        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Jabatan</label>
              <input class="form-control" type="text" name="position" placeholder="Posisi Jabatan" value="{{ old('position', $user->position) }}" >
            </div>
          </div>
          <div class="col">
            <div class="form-group">
                <label>Fakultas</label>
                <input class="form-control" type="text" placeholder="Nama Fakultas" name="faculty" value="{{ old('faculty', $user->faculty) }}">
            </div>
          </div>


          <div class="col">
            <div class="form-group">
              <label>Program Studi</label>
              <input class="form-control" type="text" placeholder="Nama Program Studi" name="study_program" value="{{ old('study_program', $user->study_program) }}">
            </div>
          </div>
        </div>

      </div>
    </div>
    {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
    <div class="mt-2">
        <p class="text-muted">
            {{ __('Your email address is unverified.') }}

            <button form="send-verification" class="btn btn-link p-0 align-baseline">
                {{ __('Click here to re-send the verification email.') }}
            </button>
        </p>

        @if (session('status') === 'verification-link-sent')
            <p class="mt-2 text-success">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
        @endif
    </div>
@endif --}}
<div class="d-flex align-items-center gap-3">
    <button type="submit" class="btn btn-primary">{{ __('Save Profile') }}</button>

    @if (session('status') === 'profile-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-muted mb-0"
        >{{ __('Saved.') }}</p>
    @endif
</div>
</form>
<hr class="mb-2 bg-primary">





