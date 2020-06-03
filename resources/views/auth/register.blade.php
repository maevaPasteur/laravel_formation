@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Inscription</h1>
            <div class="d-flex wrap mb-20">
                <div class="form-group mr-20">
                    <label for="name">{{ __('Nom') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Adresse E-Mail') }}</label>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex wrap  mb-20">
               <div class="form-group mr-20">
                   <label for="password">{{ __('Mot de passe') }}</label>
                   <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                   @error('password')
                   <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                   @enderror
               </div>
               <div class="form-group">
                   <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmation du mot de passe') }}</label>
                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
               </div>
            </div>
            <div class="form-group mb-20">
                <label for="role">{{ __('Rôle') }}</label>
                <select name="role" id="role">
                    <option value="">-- Choissiez une option --</option>
                    <option value="student">Élève</option>
                    <option value="teacher">Professeur</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group row mb-0">
                <button type="submit" class="btn purple">
                    {{ __('Register') }}
                </button>
            </div>
            <img src="/images/login.svg" alt="connexion">
        </form>
    </div>
@endsection
