@extends('layouts.app')

@section('body-class', 'page-profile')


@section('content')
   <div class="wrapper">
       <section class="mb-40">
           <h1>Bonjour {{ $user->name }}</h1>
           <h2>Mes informations</h2>
           <form class="mb-40" action="{{ route('profile.update', $user) }}" method="POST">
               @csrf
               @method('patch')
               <div class="form-group">
                   <label for="name">Nom</label>
                   <input name="name" id="name" type="text" value="{{ $user->name }}" class="@error('name') is-invalid @enderror">
                   @error('name')
                   <p class="error">{{ $errors->first('name') }}</p>
                   @enderror
               </div>
               <div class="form-group">
                   <label for="email">Email</label>
                   <input name="email" id="email" type="text" value="{{ $user->email }}" class="@error('email') is-invalid @enderror">
                   @error('email')
                   <p class="error">{{ $errors->first('email') }}</p>
                   @enderror
               </div>
               <div class="form-group">
                   <label for="email">Rôle</label>
                   <input name="role" id="role" type="text" value="{{ $user->role }}" class="@error('role') is-invalid @enderror" disabled>
                   @error('role')
                   <p class="error">{{ $errors->first('role') }}</p>
                   @enderror
               </div>
               @can(['is-teacher', 'verified'])
                   <button type="submit" class="btn purple">Ok</button>
               @endcan
           </form>
           @if($user->role == 'teacher' and $user->verified == 0)
               <p>👀 Votre profil est en attende de validation par l'administrateur</p>
           @endif
       </section>

       @can(['is-teacher'])
           @if($formations->count() > 0)
               <section class="mb-14 container_formations">
                   <h2>Mes formations</h2>
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
               </section>
               <section class="mb-40">
                   <h2>Mes sessions</h2>
                   @if($sessions)
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
                                               $has_session = null;
                                               foreach ($sessions as $session)
                                               {
                                                   if($session->start == $session_date->format('Y-m-d'))
                                                   {
                                                       $has_session = $session;
                                                   }
                                               }
                                               @endphp
                                               @if($has_session)
                                                   @php $classroom = $classrooms->where("id", $has_session->classroom_id)->first(); @endphp
                                                   <a href="/sessions/{{ $has_session->id }}" class="already">
                                                       {{ $formations->where("id", $has_session->formation_id)->first()->title }}
                                                       <br>
                                                       {{ $classroom->name }}
                                                       <br>
                                                       {{ $classroom->places }}
                                                   </a>
                                               @endif
                                           </td>
                                       @endif
                                   @endfor
                               </tr>
                           @endfor
                           </tbody>
                       </table>
                   @else
                       <p>Aucune session de programmée</p>
                   @endif
               </section>
           @else
               <section class="mb-40">
                   <h2>Mes formations</h2>
                   <p class="mb-20">Mince, vous n'avez créé aucune formation !</p>
                   <a class="btn red" href="{{ route('formations.create') }}">Créer une formation</a>
               </section>
           @endif

       @endcan

       @can('is-student')
           <section>
               <section class="mb-40">
                   @if($user->sessions->count() > 0)
                       <h2>Mes sessions à venir :</h2>
                       <ul class="list-sessions">
                           @foreach($user->sessions->where('start', '>', date('Y-m-d').' 00:00:00')->sortBy('start') as $session)
                               <li>
                                   <a href="{{ url(route('sessions.show', ['session'=>$session])) }}">
                                       <p class="fw-4">Le <?php echo(date('d/m/Y', strtotime($session->start))) ?></p>
                                       <p>Formation {{ $all_formations->where('id', $session->formation_id)->first()->title }}</p>
                                       <p>Durée : 1 journée</p>
                                       <p class="mb-20">{{ $classrooms->where('id', $session->classroom_id)->first()->name }}</p>
                                       <button class="btn yellow">Détail</button>
                                   </a>
                               </li>
                           @endforeach
                       </ul>
                   @else
                       <h3>Aucune session n'est actuellement programmée</h3>
                   @endif
               </section>
           </section>
           @if($user->sessions->count() > 0)
               <section>
                   <h2>Mon emploi du temps</h2>
                   <table class="container_calendar mb-40">
                       <thead class="top">
                       <tr>
                           <th colspan="7">
                               <a href="/profile?month=<?php echo $monthnb - 1; ?>&year=<?php echo $year; ?>"> < </a>
                               <span class="headcal"><?php echo($month.' '.$year); ?></span>
                               <a href="/profile?month=<?php echo $monthnb + 1; ?>&year=<?php echo $year; ?>"> > </a>
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
                                   $has_session = null;
                                   foreach ($user->sessions as $session)
                                   {
                                       if($session->start == $session_date->format('Y-m-d'))
                                       {
                                           $has_session = $session;
                                       }
                                   }
                                   if($has_session) {
                                       $classroom = $classrooms->where("id", $has_session->classroom_id)->first();
                                       echo ('<a href="/sessions/'.$has_session->id.'" class="already">'
                                           .$all_formations->where("id", $has_session->formation_id)->first()->title.
                                           '<br>'
                                           .$classroom->name.
                                           '<br>'
                                           .$classroom->places.
                                           '</a>');
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

           <section>
                <section class="mb-40 student-marks">
                   @if($user->sessions->count() > 0)
                       <h2>Mes notes :</h2>
                           <table class="table-note">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Formation</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->sessions->where('start', '<=', date('Y-m-d').' 00:00:00')->sortBy('start') as $session)
                                        <tr>
                                            <td><?php echo(date('d/m/Y', strtotime($session->start))) ?></th>
                                            <td class="formation">{{ \Illuminate\Support\Str::limit( $all_formations->where('id', $session->formation_id)->first()->title, 25, $end='...') }}
                                                </td>
                                            <td>
                                                @if(\Helper::getNote($session->id, $user->id ) != null)
                                                    <span class="have-note">{{ \Helper::getNote($session->id, $user->id )}}/20</span>
                                                @else
                                                    <span class="no-note">Pas encore de note</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                   @else
                       <h3>Vous n'avez pas encore de note !</h3>
                   @endif
               </section>
            </section>
       @endcan

       <img src="./images/peoples.svg" alt="personnes">
   </div>
@endsection
