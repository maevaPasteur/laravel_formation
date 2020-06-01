@extends('layouts.app')

@section('content')

    <h2>Formation : {{ $session->formation->title }}</h2>
    <h2>Session {{ $session->start  }}</h2>

    <br />

    @if($session->users->contains(auth()->user()))
        <p>Vous êtes inscrit à cette session.</p>
    @endif

    <br />

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
