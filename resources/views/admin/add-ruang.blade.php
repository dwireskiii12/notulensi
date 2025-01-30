@extends('layouts.index')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Tambah Data Ruangan</h4>

        <form class="forms-sample" action="{{ route('rooms.store') }}" method="POST">
            @csrf
          <div class="form-group col">
            <label for="name">Nama Ruangan</label>
            <input type="text" class="form-control custom-input" id="name" placeholder="Nama Ruangan" name="room_name" value="{{ old('room_name') }}">
            @error('room_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-2">
            <label for="exampleFormControlSelect1">Kapasitas Ruangan</label>
            <input type="number" class="form-control costum-input" id="name" placeholder="kapasitas Ruangan" name="capacity" value="{{ old('capacity') }}">
            @error('capacity')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary me-2">Simpan</button>
          <a class="btn btn-light" href="{{ url('rooms') }}">Batal</a>
        </form>
      </div>
    </div>
  </div>
@endsection
