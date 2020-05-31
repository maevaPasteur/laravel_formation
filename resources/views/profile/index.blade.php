@extends('layouts.app')

@section('content')
   <div class="wrapper">
       <h1>Bonjour {{ Auth::user()->name }}</h1>
       <p>Voici tes informations :</p>
       <form action="{{ route('profile.update', auth()->user()) }}" method="POST">
           @csrf
           @method('patch')
           <div class="form-group">
               <label for="name">Ton nom</label>
               <input name="name" id="name" type="text" value="{{ Auth::user()->name }}" class="@error('name') is-invalid @enderror">
               @error('name')
                    <p class="error">{{ $errors->first('name') }}</p>
               @enderror
           </div>
           <div class="form-group">
               <label for="email">Ton adresse email</label>
               <input name="email" id="email" type="text" value="{{ Auth::user()->email }}" class="@error('email') is-invalid @enderror">
               @error('email')
                    <p class="error">{{ $errors->first('email') }}</p>
               @enderror
           </div>
           <div class="form-group">
               <label for="password">Ton mot de passe</label>
               <input name="password" id="password" type="text" value="{{ Auth::user()->password }}" class="@error('password') is-invalid @enderror">
               @error('password')
                    <p class="error">{{ $errors->first('password') }}</p>
               @enderror
           </div>
           <button type="submit">Mettre à jour mes informations</button>
       </form>
   </div>
@endsection
