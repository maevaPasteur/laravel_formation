@extends('layouts.app')

@section('content')
    <section class="wrapper">
        <div class="mb-40">
            <h1>Liste des catégories</h1>
            @if($categories->count() > 0)
                <ul>
                    @foreach ($categories as $category)
                        <li>{{$category->name}}</li>
                    @endforeach
                </ul>
            @else
                <p>Aucune catégorie n'a été créé pouèr le moment</p>
            @endif
        </div>
        {!! Form::open(['url' => 'categories']) !!}
            <div class="d-flex align-end">
                <div class="form-group mr-20">
                    <label>Nom de la catégorie</label>
                    <input name="name" type="text" required>
                </div>
                <button type="submit" class="btn purple">Valider</button>
            </div>
        {!! Form::close() !!}
    </section>
@endsection
