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
        <h4 class="card-title">Form Tambah Data Pegawai</h4>

        <form class="forms-sample" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

          <div class="form-group col-md-4">
            <label for="fas">Nama Pegawai</label>
            <input type="text" class="form-control" id="fas" placeholder="Masukkan Nama Pengguna" name="name" value="{{ old('name') }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="fas">Email</label>
            <input type="email" class="form-control" id="fas" placeholder=" Masukkan Alamat Email " name="email" value="{{ old('email') }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="password">Password</label>
            <div class="input-group">
            <input type="password" class="form-control"  placeholder="Masukkan Kata Sandi" name="password" id="password" value="{{ old('password') }}">

            <button class="btn btn-default" type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none;">
                <i class="mdi mdi-eye" aria-hidden="true"></i>
            </button>

        </div>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
          </div>


          <div class="form-group col-md-4">
            <label for="fas">Posisi</label>
            <input type="text" class="form-control" id="fas" placeholder="Masukkan Nama Jabatan" name="position" value="{{ old('position') }}">
            @error('position')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>



          <div class="form-group col-md-4">
            <label for="fas">Telepon</label>
            <input type="number" class="form-control" id="fas" placeholder=" Masukkan No.Telepon" name="phone_number" value="{{ old('phone_number') }}">
            @error('phone_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="fas">Fakultas</label>
            <input type="text" class="form-control" id="fas" placeholder="Masukkan Nama Fakultas" name="faculty" value="{{ old('faculty') }}">
            @error('faculty')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="fas">Program Study</label>
            <select class="form-select" name="study_program">
                <option value="" disabled selected>----Pilih Program Study-----</option>
                <option value="Teknik Sipil">Teknik Informatika</option>
                <option value="Informatika">Sistem Informasi</option>
            </select>
            @error('program_study')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>



          <div class="form-group col-md-4">
            <label for="fas">Hak Akses</label>
            <select class="form-select" name="role" id="">
                <option value="" disabled selected>----Pilih Hak Akses-----</option>
                <option value="1">Admin</option>
                <option value="2">Sekertaris</option>
                <option value="3">Notulensi</option>
                <option value="4">User</option>
            </select>
            @error('role')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="foto">Foto</label>
            <input type="file" class="form-control"  id="foto"  name="image" value="{{ old('image') }}">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror

          </div>
<div class="col">

    <button type="submit" class="btn btn-primary me-2">Simpan</button>
<a class="btn btn-light" href="{{ url('users') }}">Batal</a>
</div>


        </div>
        </form>
      </div>
    </div>
  </div>




<script>


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

</script>
@endsection
