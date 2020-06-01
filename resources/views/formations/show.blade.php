@extends('layouts.app')

@section('content')
    <div class="wrapper container_formations-detail">

        <section class="mb-40">
            <h2>Formation en {{ $formation->title  }}</h2>

            @foreach($formation->categories as $category)
                <span class="tag">{{ $category->name }}</span>
            @endforeach

            <p class="fw-4">{{ $formation->description  }}</p>
            <br>
            <p>{{ $formation->content }}</p>
            <p class="mb-20">Formation proposée par {{  $formation->user->name }}</p>

            <div class="d-flex">
                @can('update', $formation)
                    <a class="btn dark mr-20" href="{{ route('formations.edit', $formation) }}">Modifier la formation</a>
                @endcan
                @can('delete', $formation)
                    <form action="{{ route('formations.destroy', $formation) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn red">Supprimer</button>
                    </form>
                @endcan
            </div>
        </section>


        @if (auth()->user()->id === $formation->user->id)
            <section class="mb-40">
                <h3>Ajouter une session</h3>
                <form action="{{ route('sessions.store', $formation) }}" method="POST" class="d-flex">
                    @csrf
                    <input name="formation_id" id="formation_id" type="text" hidden value="{{ $formation->id }}" />
                    <div class="form-group">
                        <label for="start">Date de la session</label>
                        <input name="start" id="start" type="date" class="@error('start') is-invalid @enderror">
                        @error('start')
                        <p class="error">{{ $errors->first('start') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="classroom_id">Choix de la salle</label>
                        <select name="classroom_id" id="classroom_id" class="@error('classroom_id') is-invalid @enderror">
                            @foreach($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }} - {{ $classroom->places }} places</option>
                            @endforeach
                        </select>
                        @error('classroom_id')
                        <p class="error">{{ $errors->first('classroom_id') }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn yellow">Ok</button>
                </form>
            </section>
        @endif

        <section class="mb-40">
            @if($sessions->count() > 0)
                <h3>Les sessions à venir :</h3>
                <ul class="list-sessions">
                    @foreach($sessions as $session)
                        <li>
                            <a href="{{ url(route('sessions.show', ['session'=>$session])) }}">
                                <p class="fw-4">Le <?php echo(date('d/m/Y', strtotime($session->start))) ?></p>
                                <p>Durée : 1 journée</p>
                                @if($session->users->count() === 0)
                                    <p class="mb-20">Sois le premier à t'inscrire !</p>
                                @elseif($session->users->count() == 1)
                                    <p class="mb-20">Déjà 1 inscrit</p>
                                @else
                                    <p class="mb-20">Déjà {{ $session->users->count() }} inscrits</p>
                                @endif
                                <button class="btn purple">En savoir +</button>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3>Aucune session n'est actuellement programmée</h3>
            @endif
        </section>
    </div>


@endsection
