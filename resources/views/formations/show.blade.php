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


        @if (auth()->user())
            @if (auth()->user()->id === $formation->user->id)
                <section class="mb-40">
                    <h3>Ajouter une session</h3>
                    <form action="{{ route('sessions.store', $formation) }}" method="POST" class="d-flex">
                        @csrf
                        <input name="formation_id" id="formation_id" type="text" hidden value="{{ $formation->id }}" />
                        <div class="form-group">
                            <label for="start">Date de la session</label>
                            <input name="start" id="start" type="date" class="@error('start') is-invalid @enderror">
                            @error('start')
                            <p class="error">{{ $errors->first('start') }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="classroom_id">Choix de la salle</label>
                            <select name="classroom_id" id="classroom_id" class="@error('classroom_id') is-invalid @enderror">
                                @foreach($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->name }} - {{ $classroom->places }} places</option>
                                @endforeach
                            </select>
                            @error('classroom_id')
                            <p class="error">{{ $errors->first('classroom_id') }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn yellow">Ok</button>
                    </form>
                </section>
            @endif
        @endif

        @if (auth()->user()->id === $formation->user->id)
            <section class="mb-40">
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
                                    echo ('<td class="'.$day_class.'">'.$day_current.'</td>');
                                }
                                echo('</tr>');
                            } ?>
                        </tbody>
                    </table>
            </section>
        @endif

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
                                    <p class="mb-20">Sois le premier à t'inscrire !</p>
                                @elseif($session->users->count() == 1)
                                    <p class="mb-20">Déjà 1 inscrit</p>
                                @else
                                    <p class="mb-20">Déjà {{ $session->users->count() }} inscrits</p>
                                @endif
                                <button class="btn purple">En savoir +</button>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3>Aucune session n'est actuellement programmée</h3>
            @endif
        </section>
    </div>


@endsection
