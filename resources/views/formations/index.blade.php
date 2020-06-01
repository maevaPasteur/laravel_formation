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
    <section class="wrapper container_formations">
            <h2>La liste des formations</h2>
            <ul>
            @foreach($formations as $formation)
                <li>
                    <article>
                        <a href="{{ route('formations.show', $formation)  }}">
                            <h3>Formation en {{ $formation->title  }}</h3>
                            @if (count($formation->categories) > 0)
                                <p>Catégorie(s) :</p>
                                @foreach($formation->categories as $category)
                                    <span>{{ $category->name }}</span>
                                @endforeach
                            @endif
                            <p>{{ $formation->description }}</p>
                            <button class="btn yellow">Voir la formation</button>
                        </a>
                    </article>
                </li>
            @endforeach

        {{ $formations->links()  }}
    </section>

@endsection
