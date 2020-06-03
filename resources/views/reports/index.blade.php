@extends('layouts.app')

@section('content')
    <section class="wrapper container_formations">
            <h2>Compte Rendus</h2>
            <ul>
            @foreach($reports as $report)
                {{ $report->url }}
            @endforeach
    </section>

@endsection
