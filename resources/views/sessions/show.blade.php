@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <h1>Formation : {{ $session->formation->title }}</h1>
        <p class="mb-20">{{ $session->formation->description }}</p>
        <table class="mb-20">
            <tr>
                <td>Date</td>
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <td>Durée</td>
                <td>1 journée</td>
            </tr>
            <tr>
                <td>Coût</td>
                <td>1000€ + 300€ de frais d'inscription</td>
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
                @canany(['is-admin', 'is-teacher'])
                    <tr>
                        <td>Compte rendu</td>
                            @if(($session->start <= date('Y-m-d')) && !is_null($session->report))
                                <td><a href="/uploads/{{ $session->report->url }}" download>{{ $session->report->url }}</a></td>
                            @elseif($session->start <= date('Y-m-d') && is_null($session->report))
                                <td>Aucun rapport n'a été écrit. Vous pouvez en uploader un.
                                    {{ $session->report }}
                                    {!! Form::open(['route' => ['reports.store', $session], 'files'=>'true']) !!}
                                        <input type="file" name="report" />
                                        {{ Form::submit('Click Me!') }}
                                    {!! Form::close() !!}
                                </td>
                            @elseif($session->start > date('Y-m-d'))
                                <td>Le rapport sera disponible une fois que la formation seras terminée.</td>
                            @endif
                    </tr>
                @endcanany
        </table>

        @can('is-teacher')

        @endcan

        <div class="mb-40">
            @can('is-student')
                @if($session->users->contains(auth()->user()))
                    <p>Vous êtes inscrit à cette session.</p>
                @elseif($places_available > 0)
                    <a href="{{ route('sessions.inscription', $session) }}" class="btn purple">S'inscrire</a>
                @else
                    <p>Il n'y a plus de place à cette formation
                @endif
            @endcan
        </div>

        @if($session->users->count() > 0)
            <h3>Liste des inscrits</h3>
            <ul class="list">
                @foreach($session->users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        @else
            <h3>Personne n'est inscrit pour le moment</h3>
        @endif

    </div>



@endsection
