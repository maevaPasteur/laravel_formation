@extends('layouts.app')

@section('content')
    <div class="wrapper container_formations-detail">

        <section class="mb-40">
            <h2>Formation en {{ $formation->title }}</h2>
            @foreach($formation->categories as $category)
                <span class="tag">{{ $category->name }}</span>
            @endforeach
            <p class="fw-4">{{ $formation->description }}</p>
            <br>
            <p>{{ $formation->content }}</p>
            <p class="mb-20">Formation proposée par {{  $formation->user->name }}</p>
            <div class="d-flex">
                @can('update', $formation)
                    <a class="btn dark mr-20" href="{{ route('formations.edit', $formation) }}">Modifier la formation</a>
                @endcan
                @can('delete', $formation)
                    <form action="{{ route('formations.destroy', $formation) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn red">Supprimer</button>
                    </form>
                @endcan
            </div>
        </section>


        <section class="mb-40">
            @if($sessions->count() > 0)
                <h3>Les sessions à venir :</h3>
                <ul class="list-sessions">
                    @foreach($sessions->sortBy('start') as $session)
                        <li>
                            <a href="{{ url(route('sessions.show', ['session'=>$session])) }}">
                                <p class="fw-4">Le <?php echo(date('d/m/Y', strtotime($session->start))) ?></p>
                                <p>Durée : 1 journée</p>
                                @if($session->users->count() === 0)
                                    @if ($formation->user->id === $formation->user->id)
                                        <p class="mb-20">Aucune inscription</p>
                                    @else
                                        <p class="mb-20">Sois le premier à t'inscrire !</p>
                                    @endif
                                @elseif($session->users->count() == 1)
                                    <p class="mb-20">Déjà 1 inscrit</p>
                                @else
                                    <p class="mb-20">Déjà {{ $session->users->count() }} inscrits</p>
                                @endif
                                <button class="btn yellow">En savoir +</button>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3>Aucune session n'est actuellement programmée</h3>
            @endif
        </section>


        @if (auth()->user() and auth()->user()->id === $formation->user->id)
            <section class="mb-40">
                <h2>Créer une nouvelle session</h2>
                <p class="mb-40">Sélectionne la salle de classe à la date souhaitée.<br>Une nouvelle session sera automatiquement ajoutée.</p>
                <form  action="{{ route('sessions.store', $formation) }}" method="POST" class="form_create-session">
                    @csrf
                    <input type="hidden" name="start" value="">
                    <table class="container_calendar">
                        <thead class="top">
                        <tr>
                            <th colspan="7">
                                <a href="/?month={{ $monthnb - 1 }}&year={{ $year }}"> < </a>
                                <span class="headcal">{{ $month.' '.$year }}</span>
                                <a href="/?month={{ $monthnb + 1 }}&year={{ $year }}"> > </a>
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
                                    @php
                                        $day_current = $formation->day_current($j, $z, $i, $monthnb, $year, $calendar)
                                    @endphp
                                    @if($day_current == '')
                                        <td><p>{{ $day_current }}</p></td>
                                    @else
                                        <td class="{{ $formation->day_class($j, $z, $i, $monthnb, $year, $calendar) }}">
                                            <p>{{ $day_current }}</p>
                                            @php
                                                $session_date_obj = $day_current.'/'.$monthnb.'/'.$year;
                                                $session_date = date_create_from_format('j/m/Y', $session_date_obj);
                                            @endphp
                                            @if($formation->has_session($user_sessions, $session_date))
                                                <span class="already">Vous donnez déjà une formation</span>
                                            @else
                                                @foreach($classrooms as $classroom)
                                                    @if($all_sessions->where('start', '=', $session_date->format('Y-m-d').' 00:00:00')->where('classroom_id', $classroom->id))
                                                        <label>
                                                            <span>{{ $classroom->name }}</span>
                                                            <span>{{ $classroom->places }} places</span>
                                                            <input type="radio" name="classroom_id" value="{{ $classroom->id }}">
                                                            <i></i>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    @endif
                                @endfor
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </form>
            </section>


        @else


            <section class="mb-40">
                <h2>Calendrier des sessions</h2>
                <table class="container_calendar">
                    <thead class="top">
                    <tr>
                        <th colspan="7">
                            <a href="/?month={{ $monthnb - 1 }}&year={{ $year }}"> < </a>
                            <span class="headcal">{{ $month.' '.$year }}</span>
                            <a href="/?month={{ $monthnb + 1 }}&year={{ $year }}"> > </a>
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
                                @php
                                    $day_current = $formation->day_current($j, $z, $i, $monthnb, $year, $calendar)
                                @endphp
                                @if($day_current == '')
                                    <td><p>{{ $day_current }}</p></td>
                                @else
                                    <td class="{{ $formation->day_class($j, $z, $i, $monthnb, $year, $calendar) }}">
                                        <p>{{ $day_current }}</p>
                                        @php
                                            $session_date_obj = $day_current.'/'.$monthnb.'/'.$year;
                                            $session_date = date_create_from_format('j/m/Y', $session_date_obj);
                                        @endphp
                                        @foreach($sessions->where("start",  "=", $session_date->format('Y-m-d')) as $session)
                                            <a class="session" href="/sessions/{{ $session->id }}">
                                                <span>{{ $formation->title }}</span><br>
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


    </div>


@endsection
