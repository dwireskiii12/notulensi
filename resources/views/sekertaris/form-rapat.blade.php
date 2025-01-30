@extends('layouts.index')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form Pengajuan Rapat</h4>

            <form class="forms-sample" action="{{ route('meeting.store') }}" method="POST">
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @csrf

                <div class="row">

                    <div class="col-md-4">



                <div class="form-group">
                    <label for="tema">Tema Rapat</label>
                    <input type="text" class="form-control custom-input" id="tema" placeholder="Tema Rapat"
                        name="meeting_theme" value="{{ old('meeting_theme') }}">
                    @error('meeting_theme')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleTextarea1">Deskripsi</label>
                    <textarea class="form-control custom-input" id="exampleTextarea1" rows="4" name="description"
                        placeholder="Masukkan deskripsi disini">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Pemimpin Rapat</label>
                    <select class="js-example-basic-single w-100 " name="meeting_leader">
                        <option value="" disabled selected>Pilih Pemimpin Rapat</option>

                        @foreach($users as $us)
                        <option value="{{ $us->user_id }}"
                            {{ old('meeting_leader') == $us->user_id ? 'selected' : '' }}> {{ $us->name }}</option>
                        @endforeach
                    </select>
                    @error('meeting_leader')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect2">Notulensi Rapat</label>
                    <select class="js-example-basic-single w-100" id="exampleFormControlSelect2" name="meeting_minutes">
                        <option value="" disabled selected>Pilih Notulensi</option>
                        @foreach($users as $us)
                        <option value="{{ $us->user_id }}"
                            {{ old('meeting_minutes')  ==  $us->user_id ? 'selected' : '' }}>{{ $us->name }}</option>
                        @endforeach
                    </select>
                    @error('meeting_minutes')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>





            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Ruangan</label>
                    <select class="js-example-basic-single w-100" id="exampleFormControlSelect1" name="room_id">
                        <option value="" disabled selected>Pilih Ruangan Rapat</option>
                        @foreach($room as $rm)
                        <option value="{{ $rm->room_id }}" {{ old('room_id') == $rm->room_id ? 'selected' : '' }}>
                            {{ $rm->room_name }}: Kapasitas {{ $rm->capacity }} Orang</option>
                        @endforeach
                    </select>
                    @error('room_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="jm_masuk">Jam Masuk</label>
                    <input type="datetime-local" class="form-control custom-input" id="jm_masuk" placeholder="Jam Masuk"
                        name="start_time" value="{{ old('start_time') }}">
                    @error('start_time')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>




                <div class="form-group">
                    <label for="jam_keluar">Jam Keluar</label>
                    <input type="datetime-local" class="form-control custom-input" id="jam_keluar"
                        placeholder="Jam Keluar" name="end_time" value="{{ old('end_time') }}">
                    @error('end_time')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">


                <div class="form-group">
                    <label for="name">Jumlah Peserta</label>
                    <input type="number" class="form-control custom-input" id="name" placeholder="Jumlah Peserta"
                        name="participant_count" id="jumlah_peserta" value="{{ old('participant_count') }}">
                    @error('participant_count')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Peserta Rapat</label>
                    <select class="js-example-basic-multiple w-100" multiple="multiple" name="user_id[]" id="user_id">

                        @foreach($users as $user)
                        <option value="{{ $user->user_id }}"
                            {{ in_array($user->user_id, old('user_id', [])) ? 'selected' : '' }}>{{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Fasilitas</label>
                    <select class="js-example-basic-multiple w-100" multiple="multiple" name="facilities[]">
                        @foreach($facilities as $f)
                        <option value="{{ $f->facilities }}"
                            {{ in_array($f->facilities, old('facilities', [])) ? 'selected' : '' }}>{{ $f->facilities }}
                        </option>
                        @endforeach
                    </select>
                    @error('facilities')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                </div>
                </div>
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
        <a class="btn btn-light" href="{{ url('meeting') }}">Batal</a>
            </form>
        </div>
    </div>
</div>


@endsection
