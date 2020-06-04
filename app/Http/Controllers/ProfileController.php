<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Formation;
use App\Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $formations = Formation::all()->where('user_id', $user->id);
        $classrooms = Classroom::all();
        $all_sessions = Session::all();
        $all_formations = Formation::all();
        $sessions = array();

        foreach ($formations as $formation)
        {
            foreach ($all_sessions->where('formation_id', $formation->id) as $session)
            {
                array_push($sessions, $session);
            }
        }

        // Get calendar data
        $date     = $this->getDate();
        $month    = $date['month'];
        $monthnb  = $date['monthnb'];
        $year     = $date['year'];
        $daytab   = $date['daytab'];
        $calendar = $date['calendar'];
        $nbdays   = $date['nbdays'];
        $z        = $date['z'];

        return view('profile.index', compact(
            'user',
            'formations',
            'sessions',
            'classrooms',
            'all_formations',
            'month',
            'monthnb',
            'year',
            'daytab',
            'calendar',
            'nbdays',
            'z'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDate()
    {
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
            case 1: $month  = 'Janvier'; break;
            case 2: $month  = 'Fevrier'; break;
            case 3: $month  = 'Mars'; break;
            case 4: $month  = 'Avril'; break;
            case 5: $month  = 'Mai'; break;
            case 6: $month  = 'Juin'; break;
            case 7: $month  = 'Juillet'; break;
            case 8: $month  = 'Août'; break;
            case 9: $month  = 'Septembre'; break;
            case 10: $month = 'Octobre'; break;
            case 11: $month = 'Novembre'; break;
            case 12: $month = 'D&eacute;cembre'; break;
        }
        return (array(
            "month"    => $month,
            "monthnb"  => $monthnb,
            "year"     => $year,
            "daytab"   => $daytab,
            "calendar" => $calendar,
            "nbdays"   => $nbdays,
            "z"        => $z
        ));
    }

}
