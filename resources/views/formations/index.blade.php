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
        @can('is-admin')
            <h1>La liste des formations</h1>
            <ul class="list-formations">
                @foreach($formations as $formation)
                    <li>
                        <article>
                            <a href="{{ route('formations.show', $formation)  }}">
                                <h2>Formation en {{ $formation->title  }}</h2>
                                <h3>
                                    @if (count($formation->categories) > 0)
                                         Catégorie(s) :
                                    @endif
                                    @foreach($formation->categories as $category)
                                        {{ $category->name }} |
                                    @endforeach
                                </h3>
                                <p>{{ $formation->description  }}</p>
                                <button>Détail de la formation</button>
                            </a>
                        </article>
                    </li>
                @endforeach
            </ul>
        @endcan

        @cannot('is-admin')
            <p>Ea cupidatat eu pariatur velit aliqua dolor amet duis exercitation eiusmod. Proident esse mollit tempor ex dolor cupidatat dolor anim id reprehenderit anim deserunt. Officia amet aliqua mollit voluptate ullamco est Lorem in irure. Sint occaecat quis tempor ullamco duis qui non exercitation. Laboris exercitation est laboris aliqua labore laboris laboris tempor.</p>
        @endcannot
        {{ $formations->links()  }}
    </section>

@endsection
