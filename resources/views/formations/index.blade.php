@extends('layouts.app')

@section('content')
    <h1>La liste des formations</h1>
    <ul>
        @foreach($formations as $formation)
            <li>
                <article>
                    <a href="{{ route('formations.show', $formation)  }}">
                        <h2>Formation en {{ $formation->title  }}</h2>
                        <p>{{ $formation->description  }}</p>
                        <p>Formation proposée par {{  $formation->user->name }}</p>
                    </a>
                </article>
            </li>
        @endforeach
    </ul>
    {{ $formations->links()  }}
@endsection
