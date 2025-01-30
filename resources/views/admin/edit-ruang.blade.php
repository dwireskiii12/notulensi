@extends('layouts.index')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Form Edit Data Ruangan</h4>

        <form class="forms-sample" action="{{ route('rooms.update', $room) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group col">
                <label for="name">Nama Ruangan</label>
                <input type="text" class="form-control costum-input" id="name" placeholder="Nama Ruangan" name="room_name" value="{{ $room->room_name }}">
                @error('room_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-2">
                <label for="exampleFormControlSelect1">Kapasitas </label>
                <input type="number" class="form-control costum-input" id="name" placeholder="kapasitas Ruangan" name="capacity" value="{{ $room->capacity }}">
                @error('capacity')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

          <button type="submit" class="btn btn-warning me-2">Update</button>
          <a class="btn btn-light" href="{{ url('rooms') }}">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection
