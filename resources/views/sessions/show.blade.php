@extends('layouts.app')

@section('content')
    {{ $session->users }}
    <h2>Session {{ $session->start  }}</h2>
    <p>Formation : {{ $session->formation->title }}</p>
    <a href="{{ route('sessions.inscription', $session)  }}">S'inscrire</a>

@endsection
