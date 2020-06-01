@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => 'categories']) !!}
                        {!! Form::text('name') !!}
                        {!! Form::submit('Post a category') !!}
                    {!! Form::close() !!}

                    <br />

                    <ul>
                        @foreach ($categories as $category)
                            <li>{{$category->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
