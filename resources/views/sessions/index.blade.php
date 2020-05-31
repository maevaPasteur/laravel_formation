@extends('layouts.app')

@section('content')
    <h1>La liste des sessions</h1>
    <ul class="list-formations">
        @foreach($sessions as $session)
            <li>
                <article>
                    <h2>Le : {{ $session->start }}</h2>
                    <p>Inscripitons ouvertes ? {{ $session->open }}</p>
                </article>
            </li>
        @endforeach
    </ul>
    {{ $formations->links()  }}
@endsection
