@extends('layouts.app')

@section('body-class', 'page-home')

@section('content')
    <section class="container_presentation">
        <div>
            <h1>Formations professionnelles</h1>
            <p>Envie de monter en compétence ?<br>Inscris toi sans tarder à une de nos formations !</p>
        </div>
        <img src="./images/background.jpg" alt="organisme de formation">
    </section>
    <section class="wrapper container_formations">
            <h2>La liste des formations</h2>
            @if ($formations->count() > 0)
                <ul>
                @foreach($formations as $formation)
                    <li>
                        <article>
                            <a href="{{ route('formations.show', $formation) }}">
                                <h3>Formation en {{ $formation->title }}</h3>
                                @if (count($formation->categories) > 0)
                                    <div class="d-flex">
                                        @foreach($formation->categories as $category)
                                            <span class="tag">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <p>{{ $formation->description }}</p>
                                <button class="btn yellow">Voir la formation</button>
                            </a>
                        </article>
                    </li>
                @endforeach
                </ul>
                {{ $formations->links() }}
            @else
                <p>Aucune formation pour le moment</p>
            @endif
    </section>
    @if($sessions->count() > 0)
        <section class="wrapper">
            <h2>Les prochaines sessions</h2>
            <table class="container_calendar">
                <thead class="top">
                <tr>
                    <th colspan="7">
                        <a href="{{ route('formations.index', $formations) }}/?month={{ $monthnb - 1 }}&year={{ $year }}"> < </a>
                        <span class="headcal">{{ $month.' '.$year }}</span>
                        <a href="{{ route('formations.index', $formations) }}/?month={{ $monthnb + 1 }}&year={{ $year }}"> > </a>
                    </th>
                </tr>
                <tr>
                    @for ($i = 1; $i <= 7; $i++)
                        <th>{{ $daytab[$i] }}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @for ($i = 1; $i <= count($calendar); $i++)
                    <tr>
                        @for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++)
                            @php $day_current = $formation->day_current($j, $z, $i, $monthnb, $year, $calendar) @endphp
                            @if($day_current == '')
                                <td><p>{{ $day_current }}</p></td>
                            @else
                                <td class="{{ $formation->day_class($j, $z, $i, $monthnb, $year, $calendar) }}">
                                    <p>{{ $day_current }}</p>
                                    @foreach($formation->sessions_this_day($sessions, $day_current, $monthnb, $year) as $session)
                                        <a class="session" href="{{ route('sessions.show', $session) }}">
                                            <span>{{ $formations->where('id', $session->formation_id)->first()->title }}</span><br>
                                            {{ $classrooms->where("id", $session->classroom_id)->first()->places - $session->users->count() }} places dispo
                                        </a>
                                    @endforeach
                                </td>
                            @endif
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </section>
    @endif


@endsection
