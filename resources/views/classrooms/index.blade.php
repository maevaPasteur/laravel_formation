@extends('layouts.app')

@section('content')
    <section class="wrapper section-classrooms">
        <div class="mb-40">
            <h1>Les salles de classe</h1>
            @if($classrooms->count() > 0)
                <ul>
                    @foreach ($classrooms as $classroom)
                        <li>{{$classroom->name}}, {{$classroom->places}} places</li>
                    @endforeach
                </ul>
            @else
                <p>Aucune classe n'a été créé pour l'instant</p>
            @endif
        </div>
        {!! Form::open(['url' => 'classrooms']) !!}
        <div class="d-flex wrap">
            <div class="form-group mr-20">
                <label>Nom de la classe</label>
                {!! Form::text('name') !!}
            </div>
            <div class="form-group mr-20">
                <label>Nombre de places</label>
                <input type="number" max="20" name="places">
            </div>
            <button type="submit" class="btn purple">Créer la salle</button>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
