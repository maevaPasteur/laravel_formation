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
            <ul>
            @foreach($formations as $formation)
                <li>
                    <article>
                            @can('verified', auth()->user())
                                <a href="{{ route('formations.show', $formation) }}">
                            @endcan
                            <h3>Formation en {{ $formation->title }}</h3>
                            @if (count($formation->categories) > 0)
                                <div class="d-flex">
                                    @foreach($formation->categories as $category)
                                        <span class="tag">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <p>{{ $formation->description }}</p>
                            @can('verified', auth()->user())
                                <button class="btn yellow">Voir la formation</button>
                            </a>
                        @endcan
                    </article>
                </li>
            @endforeach
            </ul>
        {{ $formations->links() }}
    </section>
    <section class="wrapper">
        <h2>Les prochaines sessions</h2>
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
        <table class="container_calendar">
            <thead class="top">
            <tr>
                <th colspan="7">
                    <a href="/?month=<?php echo $monthnb - 1; ?>&year=<?php echo $year; ?>"> < </a>
                    <span class="headcal"><?php echo($month.' '.$year); ?></span>
                    <a href="/?month=<?php echo $monthnb + 1; ?>&year=<?php echo $year; ?>"> > </a>
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
                            $formation = $formations->where('id', $session->formation_id)->first();
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

@endsection
