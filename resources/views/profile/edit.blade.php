{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> --}}

      {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
@extends('layouts.index')
@section('content')
{{--
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


        </div>
    </div> --}}

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-image: url('{{ asset('img/' . $user->image) }}'); background-size: cover; background-position: center;">
                        {{-- <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span> --}}
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ Auth::user()->name }}</h4>
                    <p class="mb-0">{{ Auth::user()->email }}</p>

                  </div>
                  <div class="text-center text-sm-right">

                    <span class="badge badge-dark">
                        @switch(Auth::user()->role)
                        @case(1)
                            Admin
                            @break
                        @case(2)
                            Sekertaris
                            @break
                        @case(3)
                            Notulensi
                            @break
                        @case(4)
                            User
                            @break
                        @default
                            Unknown Role
                    @endswitch</span>
                    <div class="text-danger"><small>Joined  {{ Auth::user()->created_at }}</small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                    @include('profile.partials.update-profile-information-form')

                </div>
                <div class="tab-pane active mt-3">


                    @include('profile.partials.update-password-form')

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

  </div>

</div>

@endsection
