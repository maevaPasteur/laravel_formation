@extends('layouts.app')

@section('body-class', 'page-home')

@section('content')
    <section class="container_presentation">
        <div>
            <h1>Formations professionnelles</h1>
            <p>Envie de monter en compétence ?<br>Inscris toi sans tarder à une de nos formations !</p>
        </div>
        <img src="./images/background.jpg" alt="organisme de formation">
    </section>
    <section class="wrapper">
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
    </section>

@endsection
