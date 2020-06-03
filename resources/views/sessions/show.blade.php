@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <a href="/formations/{{ $session->formation->id }}" class="btn yellow mb-40">Retour à la formation</a>
        <h1>Session de la formation {{ $session->formation->title }}</h1>
        <p class="mb-20">{{ $session->formation->description }}</p>
        <table class="mb-20 table-sessions">
            <tr>
                <td>Date</td>
                <td>{{ $date_beautify }}</td>
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
                @canany(['is-admin', 'is-teacher'])
                    <tr>
                        <td>Compte rendu</td>
                            @if(($session->start <= date('Y-m-d')) && !is_null($session->report))
                                <td><a href="/uploads/{{ $session->report->url }}" download>{{ $session->report->url }}</a></td>
                            @elseif($session->start <= date('Y-m-d') && is_null($session->report) && auth()->user()->role === "teacher")
                                <td>Aucun rapport n'a été écrit. Vous pouvez en uploader un.
                                    {{ $session->report }}
                                    {!! Form::open(['route' => ['reports.store', $session], 'files'=>'true']) !!}
                                        <input type="file" name="report" />
                                        {{ Form::submit('Click Me!') }}
                                    {!! Form::close() !!}
                                </td>
                            @elseif($session->start > date('Y-m-d'))
                                <td>Le rapport sera disponible une fois que la formation seras terminée.</td>
                            @else
                                <td>Aucun rapport n'est disponible pour le moment</td>
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
                    <p>Il n'y a plus de place disponible pour cette formation 🤭</p>
                @endif
            @endcan
        </div>
        @if($session->users->count() > 0 and auth()->user() and auth()->user()->id === $teacher->id)
            <h3>Les inscrits :</h3>
            <ul class="list">
                @if($current_time > $date)
                    @can('is-teacher')
                        <form action="{{ route('sessions.updateNote', $session) }}" method="POST">
                            @csrf
                            @method('patch')
                    @endcan
                @endif

                @foreach($session->users as $user)
                <li>
                    <div class="form-group form-students-sessions">
                        <p>{{ $user->name }}</p>
                            @if($current_time > $date)
                                @can('is-teacher')
                                    <input name="note_{{ $user->id }}" id="note_{{ $user->id }}" type="number" placeholder="Donnez une note" value="{{ \Helper::getNote($session->id, $user->id )}}" min="0" max="20" class="@error('note') is-invalid @enderror">
                                    @error('note')
                                        <p class="error">{{ $errors->first('note') }}</p>
                                    @enderror
                                @endcan
                            @endif
                    </div>
                </li>
                @endforeach

                @if($current_time > $date)
                    @can('is-teacher')
                        <br />
                        <button class="btn dark" type="submit">Enregistrer les notes</button>
                        </form>
                    @endcan
                @endif
            </ul>
        @endif
    </div>



@endsection
