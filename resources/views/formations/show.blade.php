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

        <?php
        $year = date("Y");
        if(!isset($_GET['month'])) $monthnb = date("n");
        else {
            $monthnb = $_GET['month'];
            $year = $_GET['year'];
            if($monthnb <= 0) {
                $monthnb = 12;
                $year = $year - 1;
            }
            elseif($monthnb > 12) {
                $monthnb = 1;
                $year = $year + 1;
            }
        }
        $day = date("w");
        $nbdays = date("t", mktime(0,0,0,$monthnb,1,$year));
        $firstday = date("w",mktime(0,0,0,$monthnb,1,$year));
        $daytab[1] = 'Lundi';
        $daytab[2] = 'Mardi';
        $daytab[3] = 'Mercredi';
        $daytab[4] = 'Jeudi';
        $daytab[5] = 'Vendredi';
        $daytab[6] = 'Samedi';
        $daytab[7] = 'Dimanche';
        $calendar = array();
        $z = (int)$firstday;
        if($z == 0) $z =7;
        for($i = 1; $i <= ($nbdays/5); $i++){
            for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++){
                if($j < $z && ($j-$z+1+(($i*7)-7)) <= 0){
                    $calendar[$i][$j] = null;
                }
                else {
                    $calendar[$i][$j] = $j-$z+1+(($i*7)-7);
                }
            }
        }
        switch($monthnb) {
            case 1: $month = 'Janvier'; break;
            case 2: $month = 'Fevrier'; break;
            case 3: $month = 'Mars'; break;
            case 4: $month = 'Avril'; break;
            case 5: $month = 'Mai'; break;
            case 6: $month = 'Juin'; break;
            case 7: $month = 'Juillet'; break;
            case 8: $month = 'Août'; break;
            case 9: $month = 'Septembre'; break;
            case 10: $month = 'Octobre'; break;
            case 11: $month = 'Novembre'; break;
            case 12: $month = 'D&eacute;cembre'; break;
        }
        ?>

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
                                <a href="/formations/{{ $formation->id }}?month=<?php echo $monthnb - 1; ?>&year=<?php echo $year; ?>"> < </a>
                                <span class="headcal"><?php echo($month.' '.$year); ?></span>
                                <a href="/formations/{{ $formation->id }}?month=<?php echo $monthnb + 1; ?>&year=<?php echo $year; ?>"> > </a>
                            </th>
                        </tr>
                        <tr>
                            <?php for($i = 1; $i <= 7; $i++){
                                echo('<th>'.$daytab[$i].'</th>');
                            }?>
                        </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 1; $i <= count($calendar); $i++) {
                                echo('<tr>');
                                for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++){
                                    if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) {
                                        $day_class = 'currentday';
                                        $day_current = $calendar[$i][$j];
                                    } else {
                                        if ( $calendar[$i][$j] == "" ) {
                                            $day_class = 'jourVide';
                                            $day_current = '';
                                        } else {
                                            $jour = $calendar[$i][$j];
                                            $datecomplete = $year."-".$monthnb."-".$jour;
                                            $day_class = 'otherDay';
                                            $day_current = $calendar[$i][$j];
                                        }
                                    }
                                    // Hide days of the week before the 1rst on the month
                                    if($day_current == '') {
                                        echo('<td><p>'.$day_current.'</p></td>');
                                    } else {
                                        $session_date_obj = $day_current.'/'.$monthnb.'/'.$year;
                                        $session_date = date_create_from_format('j/m/Y', $session_date_obj);
                                        echo ('<td data-start="'.$session_date->format('Y-m-d').' 00:00:00" class="'.$day_class.'">');
                                        echo('<p>'.$day_current.'</p>');

                                        // Test if user has already a session on this date
                                        $has_session = false;
                                        foreach ($user_sessions as $session_active)
                                        {
                                            if($session_active->start == $session_date->format('Y-m-d'))
                                            {
                                                $has_session = true;
                                            }
                                        }
                                        if($has_session) {
                                            echo ('<span class="already">Vous donnez déjà une formation</span>');
                                        } else {
                                            foreach($classrooms as $classroom) {
                                                $available = $all_sessions->where('start', '=', $session_date->format('Y-m-d').' 00:00:00')->where('classroom_id', $classroom->id);
                                                if($available->count() == 0) {
                                                    echo('<label>
                                                <span>'.$classroom->name.'</span>
                                                <span>'.$classroom->places.' places</span>
                                                <input type="radio" name="classroom_id" value="'.$classroom->id.'">
                                                <i></i>
                                            </label>');
                                                }
                                            }
                                            echo('</td>');
                                        }
                                    }
                                }
                                echo('</tr>');
                            } ?>
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
                            <a href="/formations/{{ $formation->id }}?month=<?php echo $monthnb - 1; ?>&year=<?php echo $year; ?>"> < </a>
                            <span class="headcal"><?php echo($month.' '.$year); ?></span>
                            <a href="/formations/{{ $formation->id }}?month=<?php echo $monthnb + 1; ?>&year=<?php echo $year; ?>"> > </a>
                        </th>
                    </tr>
                    <tr>
                        <?php for($i = 1; $i <= 7; $i++){
                            echo('<th>'.$daytab[$i].'</th>');
                        }?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 1; $i <= count($calendar); $i++) {
                        echo('<tr>');
                        for($j = 1; $j <= 7 && $j-$z+1+(($i*7)-7) <= $nbdays; $j++){
                            if($j-$z+1+(($i*7)-7) == date("j") && $monthnb == date("n") && $year == date("Y")) {
                                $day_class = 'currentday';
                                $day_current = $calendar[$i][$j];
                            } else {
                                if ( $calendar[$i][$j] == "" ) {
                                    $day_class = 'jourVide';
                                    $day_current = '';
                                } else {
                                    $jour = $calendar[$i][$j];
                                    $datecomplete = $year."-".$monthnb."-".$jour;
                                    $day_class = 'otherDay';
                                    $day_current = $calendar[$i][$j];
                                }
                            }
                            // Hide days of the week before the 1rst on the month
                            if($day_current == '') {
                                echo('<td><p>'.$day_current.'</p></td>');
                            } else {
                                $session_date_obj = $day_current.'/'.$monthnb.'/'.$year;
                                $session_date = date_create_from_format('j/m/Y', $session_date_obj);
                                echo ('<td class="'.$day_class.'">');
                                echo('<p>'.$day_current.'</p>');
                                $sessions_this_day = $sessions->where("start",  "=", $session_date->format('Y-m-d'));
                                foreach ($sessions_this_day as $session)
                                {
                                    $classroom = $classrooms->where("id", $session->classroom_id)->first();
                                    $places_availables = $classroom->places - $session->users->count();
                                    echo ('<a class="session" href="/sessions/'.$session->id.'">
                                <span>'.$formation->title.'</span><br>'.$places_availables.' places dispo
                            </a>');
                                }
                                echo('</td>');
                            }
                        }
                        echo('</tr>');
                    } ?>
                    </tbody>
                </table>
            </section>
        @endif


    </div>


@endsection
