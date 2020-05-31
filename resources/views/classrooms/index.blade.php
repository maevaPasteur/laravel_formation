@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Salles</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => 'classrooms']) !!}
                        {!! Form::text('name') !!}
                        {!! Form::number('places') !!}
                        {!! Form::submit('Post a room') !!}
                    {!! Form::close() !!}

                    <br />

                    <ul>
                        @foreach ($classrooms as $classroom)
                            <li>{{$classroom->name}}, {{$classroom->places}} places</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
