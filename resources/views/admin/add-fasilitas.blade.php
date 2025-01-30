@extends('layouts.index')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Form Tambah Data Fasilitas</h4>

        <form class="forms-sample" action="{{ route('fas.store') }}" method="POST">
            @csrf
          <div class="form-group col">
            <label for="fas">Nama Fasilitas</label>
            <input type="text" class="form-control costum-input" id="fas" placeholder="Nama Fasiilitas" name="facilities" value="{{ old('facilities') }}">
            @error('facilities')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary me-2">Simpan</button>
          <a class="btn btn-light" href="{{ url('fas') }}">Batal</a>
        </form>
      </div>
    </div>
  </div>
@endsection
