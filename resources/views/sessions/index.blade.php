@extends('layouts.app')

@section('content')
    <section class="wrapper">
        <h1>Sessions</h1>
        <ul class="list-sessions">
            @foreach($sessions as $session)
                <li>
                    <a href="{{ url(route('sessions.show', ['session'=>$session])) }}">
                        <p class="fw-4">Le {{ $session->start }}</p>
                        <h2>{{ $session->formation->title }}</h2>
                        @if($session->users->count() > 1)
                            <p>{{ $session->users->count() }} inscrits</p>
                        @else
                            <p>{{ $session->users->count() }} inscrit</p>
                        @endif
                        <p class="mb-20">{{ $session->classroom->places - $session->users->count() }} places restantes</p>
                        <button class="btn yellow">En savoir +</button>
                        {{-- @can('delete', $session)
                            <form action="{{ route('sessions.destroy', $session) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn red">Supprimer</button>
                            </form>
                        @endcan --}}
                    </a>
                </li>
            @endforeach
        </ul>
        {{ $sessions->links() }}
    </section>

@endsection
