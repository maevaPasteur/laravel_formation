@extends('layouts.app')

@section('content')
    <form action="{{ route('formations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre</label>
            <input name="title" id="title" type="text" placeholder="Javascript avancé" class="@error('title') is-invalid @enderror">
            @error('title')
                <p class="error">{{ $errors->first('title') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Courte description de la formation</label>
            <textarea name="description" id="description" maxlength="180" placeholder="Apprendre l'ES6, la programmation orientée objet, créer des classes, des méthodes, etc." class="@error('description') is-invalid @enderror"></textarea>
            @error('description')
                <p class="error">{{ $errors->first('description') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Contenu détaillé de la formation</label>
            <textarea name="content" id="content" maxlength="1000" placeholder="Dans cette formation nous verrons comment..." class="@error('content') is-invalid @enderror"></textarea>
            @error('content')
                <p class="error">{{ $errors->first('content') }}</p>
            @enderror
        </div>

        <button type="submit">Créer ma formation</button>
    </form>
@endsection
