@extends('layouts.app')

@section('content')

    <section class="wrapper">
        <h1>Connexion</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="d-flex wrap  mb-20">
                <div class="form-group mr-20">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="form-group wrap  mb-20 d-flex">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <div class="form-group mb-40">
                <button type="submit" class="btn yellow mr-20">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
        <img src="/images/login.svg" alt="connexion">
    </section>
@endsection
