@extends('layouts.index')
<style>
   .input-group {
        position: relative;
    }

    #password {
        padding-right: 30px; /* Adjust based on icon size */
    }

    #togglePassword {
        cursor: pointer;
    }

</style>

@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Edit Data Pengguna</h4>

            <form class="forms-sample" action="{{ route('users.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                <div class="form-group col-md-4">
                    <label for="name">Nama Pengguna</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="phone_number">Telepon</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                    @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group col-md-4">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <button class="btn btn-default" type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none;">
                            <i class="mdi mdi-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>




                <div class="form-group col-md-4">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    <button class="btn btn-default" type="button" id="togglePassword1" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none;">
                        <i class="mdi mdi-eye" aria-hidden="true"></i>
                    </button>
                </div>
                </div>


                <div class="form-group col-md-4">
                    <label for="position">Posisi</label>
                    <input type="text" class="form-control" id="position" name="position" value="{{ $user->position }}">
                    @error('position')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group col-md-4">
                    <label for="faculty">Fakultas</label>
                    <input type="text" class="form-control" id="faculty" name="faculty" value="{{ $user->faculty }}">
                    @error('faculty')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="study_program">Program Study</label>
                    <select class="form-select" name="study_program">
                        <option value="" disabled>----Pilih Program Study-----</option>
                        <option value="Teknik Informatika" {{ $user->study_program == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                        <option value="Sistem Informasi" {{ $user->study_program == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                    </select>
                    @error('program_study')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="role">Hak Akses</label>
                    <select class="form-select" name="role" id="roleSelect">
                        <option value="" disabled>----Pilih Hak Akses-----</option>
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Sekretaris</option>
                        <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Notulensi</option>
                        <option value="4" {{ $user->role == 4 ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


          <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control"  id="foto"  name="image" value="{{ old('image',$user->image) }}">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2">
                <img src="{{ asset('img/' . $user->image) }}" alt="{{ $user->image }}" width="200" height="200">
            </div>
          </div>


            </div>
                <button type="submit" class="btn btn-success me-2">Update</button>
                <a class="btn btn-light" href="{{ route('users.index') }}">Batal</a>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var roleSelect = document.getElementById('roleSelect');
        var userRole = "{{ $user->role }}";

        // If user role is 1 (Admin), disable the select
        if (userRole === '1') {
            roleSelect.readonly = true;
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the icon class
            const icon = this.querySelector('i');
            icon.classList.toggle('mdi-eye');
            icon.classList.toggle('mdi-eye-off');
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword1');
        const passwordInput = document.getElementById('password_confirmation');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the icon class
            const icon = this.querySelector('i');
            icon.classList.toggle('mdi-eye');
            icon.classList.toggle('mdi-eye-off');
        });
    });
</script>

@endsection
