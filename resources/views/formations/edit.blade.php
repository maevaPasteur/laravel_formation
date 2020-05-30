@extends('layouts.app')

@section('content')
    {{ $formation->title }}
    <form action="{{ route('formations.update', $formation) }}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="title">Titre</label>
            <input name="title" id="title" type="text" value="{{ $formation->title }}" placeholder="Javascript avancé" class="@error('title') is-invalid @enderror">
            @error('title')
                <p class="error">{{ $errors->first('title') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Courte description de la formation</label>
            <textarea name="description" id="description" maxlength="180" placeholder="Apprendre l'ES6, la programmation orientée objet, créer des classes, des méthodes, etc." class="@error('description') is-invalid @enderror">
                {{ $formation->description }}
            </textarea>
            @error('description')
                <p class="error">{{ $errors->first('description') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Contenu détaillé de la formation</label>
            <textarea name="content" id="content" maxlength="1000" placeholder="Dans cette formation nous verrons comment..." class="@error('content') is-invalid @enderror">
                {{ $formation->content }}
            </textarea>
            @error('content')
                <p class="error">{{ $errors->first('content') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="date">Date du début de la formation</label>
            <input name="date" id="date" value="{{ $formation->date }}" type="date" class="@error('date') is-invalid @enderror">
            @error('date')
                <p class="error">{{ $errors->first('date') }}</p>
            @enderror
        </div>
        <button type="submit">Mettre à jour ma formation</button>
    </form>
@endsection
