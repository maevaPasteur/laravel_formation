@extends('layouts.app')

@section('content')

    <h2>Session {{ $session->start  }}</h2>
    <p>Formation : {{ $session->formation->title }}</p>

    <h3>Liste des inscrits</h3>
    <ul>
    @foreach($session->users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
    </ul>

    @if(!$session->users->contains(auth()->user()))
        <a href="{{ route('sessions.inscription', $session)  }}">S'inscrire</a>
    @endif

@endsection
