@extends('layouts.app')

@section('content')
    <h1>Sessions</h1>
    <ul class="list-sessions">
        @foreach($sessions as $session)
            <li>
                <article>
                    <h2>Le : {{ $session->start }}</h2>
                    <h3>Formation : {{ $session->formation->title }}</h3>
                    <h3>Places restantes : {{ $session->classroom->places - $session->users->count() }}</h3>
                    <p>Inscripitons ouvertes ? {{ $session->open }}</p>
                    <a href={{ url("/sessions/{$session->id}") }}>En savoir +</a>
                    {{-- @can('delete', $session)
                        <form action="{{ route('sessions.destroy', $session) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn red">Supprimer</button>
                        </form>
                    @endcan --}}
                </article>
            </li>
        @endforeach
    </ul>
@endsection
