@extends('layouts.welcome')

@section('title')
    Login - Klinik Mitra Delima
@endsection

@section('content')
    <form method="POST" action="{{ route('auth.login') }}" role="form">
        @csrf
        @method('POST')
        <div class="form-group mb-3">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                </div>
                <input id="nik" type="nik" onkeypress="return hanyaAngka(event)" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" autocomplete="nik" autofocus placeholder="NIK">
                @error('nik')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-4">Login</button>
        </div>
    </form>
@endsection