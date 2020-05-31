@extends('layouts.app')

@section('content')
    <h1>La liste des formations</h1>
    <ul class="list-formations">
        @foreach($formations as $formation)
            <li>
                <article>
                    <a href="{{ route('formations.show', $formation)  }}">
                        <h2>Formation en {{ $formation->title  }}</h2>
                        <p>{{ $formation->description  }}</p>
                        <button>Détail de la formation</button>
                    </a>
                </article>
            </li>
        @endforeach
    </ul>
    {{ $formations->links()  }}
@endsection
