@extends('layouts.app')

@section('content')
    <section class="wrapper edit-formation">
        <h1> {{ $formation->title }}</h1>
        <form action="{{ route('formations.update', $formation) }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-group mb-20">
                <label for="title">Titre</label>
                <input name="title" id="title" type="text" value="{{ $formation->title }}" placeholder="Javascript avancé" class="@error('title') is-invalid @enderror">
                @error('title')
                <p class="error">{{ $errors->first('title') }}</p>
                @enderror
            </div>
            <div class="form-group mb-20">
                <label for="description">Courte description de la formation</label>
                <textarea name="description" id="description" maxlength="180" placeholder="Apprendre l'ES6, la programmation orientée objet, créer des classes, des méthodes, etc." class="@error('description') is-invalid @enderror">
                    {{ $formation->description }}
                </textarea>
                @error('description')
                <p class="error">{{ $errors->first('description') }}</p>
                @enderror
            </div>
            <div class="form-group mb-20">
                <label for="content">Contenu détaillé de la formation</label>
                <textarea name="content" id="content" maxlength="1000" placeholder="Dans cette formation nous verrons comment..." class="@error('content') is-invalid @enderror">
                    {{ $formation->content }}
                </textarea>
                @error('content')
                <p class="error">{{ $errors->first('content') }}</p>
                @enderror
            </div>
            <button type="submit" class="btn purple">Mettre à jour ma formation</button>
        </form>
    </section>
@endsection
