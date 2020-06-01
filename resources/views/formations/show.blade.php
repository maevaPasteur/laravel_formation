@inject('Carbon', 'Carbon\Carbon')
@extends('layouts.app')

@section('content')
    <h2>Formation en {{ $formation->title  }}</h2>
    <h3>Catégorie(s) de la formation : 
        @foreach($formation->categories as $category)
            {{ $category->name }} | 
        @endforeach
    </h3>
    <p>{{ $formation->description  }}</p>
    <p>Formation proposée par {{  $formation->user->name }}</p>

    @can('update', $formation)
    <a class="btn" href="{{ route('formations.edit', $formation) }}">Modifier la formation</a>
    @endcan

    @can('delete', $formation)
    <form action="{{ route('formations.destroy', $formation) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
    @endcan

    <h3>La liste des sessions</h3>
    <ul>
        @foreach($sessions as $session)
            <li>
                <a href="{{ url(route('sessions.show', ['session'=>$session])) }}">
                    {{ $session->start }}
                </a>
            </li>
        @endforeach
    </ul>

    <br><br><br>

    <h3>AJouter une session</h3>
    <form action="{{ route('sessions.store', $formation) }}" method="POST">
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
        <button type="submit">Validé</button>
    </form>

@endsection
