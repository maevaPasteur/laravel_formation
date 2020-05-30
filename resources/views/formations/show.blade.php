@extends('layouts.app')

@section('content')
    <h2>Formation en {{ $formation->title  }}</h2>
    <p>{{ $formation->description  }}</p>
    <p>Le {{ $formation->date }}</p>
    <p>Formation proposée par {{  $formation->user->name }}</p>

    @can('update', $formation)
    <a href="{{ route('formations.edit', $formation) }}">Modifier la formation</a>
    @endcan

    @can('delete', $formation)
    <form action="{{ route('formations.destroy', $formation) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
    @endcan

@endsection
