@extends('layouts.index')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Edit Data Fasilitas</h4>

        <form class="forms-sample" action="{{ route('fas.update', $fas->facilities_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group col">
                <label for="facilities">Nama Fasilitas</label>
                <input type="text" class="form-control costum-input" id="facilities" placeholder="Nama Fasilitas" name="facilities" value="{{ $fas->facilities }}">
                @error('facilities')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
          <button type="submit" class="btn btn-warning me-2">Update</button>
          <a class="btn btn-light" href="{{ url('fas') }}">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection
