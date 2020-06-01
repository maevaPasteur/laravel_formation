@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <a href="/formations/{{ $session->formation->id }}" class="btn yellow mb-40">Retour à la formation</a>
        <h1>Session de la formation {{ $session->formation->title }}</h1>
        <p class="mb-20">{{ $session->formation->description }}</p>
        <table class="mb-20 table-sessions">
            <tr>
                <td>Date</td>
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <td>Enseignant</td>
                <td>{{ $teacher->name }}</td>
            </tr>
            <tr>
                <td>Début</td>
                <td>9h</td>
            </tr>
            <tr>
                <td>Durée</td>
                <td>7h</td>
            </tr>
            <tr>
                <td>Salle</td>
                <td>{{ $session->classroom->name }}</td>
            </tr>
            <tr>
                <td>Nombre de places</td>
                <td>{{ $session->classroom->places }}</td>
            </tr>
            <tr>
                <td>Nombre d'inscrit</td>
                <td>{{ $session->users->count() }}</td>
            </tr>
            <tr>
                <td>Places restantes</td>
                <td>{{ $places_available }}</td>
            </tr>
        </table>

        <div class="mb-40">
            @can('is-student')
                @if($session->users->contains(auth()->user()))
                    <p>Vous êtes inscrit à cette session.</p>
                @elseif($places_available > 0)
                    <a href="{{ route('sessions.inscription', $session) }}" class="btn purple">S'inscrire</a>
                @else
                    <p>Il n'y a plus de place disponible pour cette formation 🤭</p>
                @endif
            @endcan
        </div>
        @if($session->users->count() > 0)
            <h3>Les inscrits :</h3>
            <ul class="list">
                @foreach($session->users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        @else
            <h3>Personne n'est inscrit pour le moment 🙀</h3>
        @endif
    </div>



@endsection
