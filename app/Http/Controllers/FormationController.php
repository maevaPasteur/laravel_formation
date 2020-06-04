<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Formation;
use App\Session;
use App\Category;
use App\User;
use Illuminate\Http\Request;

class FormationController extends Controller
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
        $formations = Formation::latest()->paginate(6);
        $all_formations = Formation::all();
        $sessions = Session::all();
        $classrooms = Classroom::all();
        $teachers = User::all()->where('role', 'teacher');

        // Get calendar data
        $date     = $this->getDate();
        $month    = $date['month'];
        $monthnb  = $date['monthnb'];
        $year     = $date['year'];
        $daytab   = $date['daytab'];
        $calendar = $date['calendar'];
        $nbdays   = $date['nbdays'];
        $z        = $date['z'];

        return view('formations.index', compact(
            'formations',
            'all_formations',
            'sessions',
            'classrooms',
            'teachers',
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::all()->where('role', 'teacher');
        $categories = Category::all();
        return view('formations.create', compact(['categories', 'teachers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:3',
            'description' => 'required|min:10',
            'content'     => 'required|min:30'
        ]);

        if (auth()->user()->role === "teacher") {
            $formation = auth()->user()->formations()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'content'     => $request->content
        ]);
        $category = Category::find($request->category);
        $formation->categories()->attach($category);

        return redirect()->route('formations.show', $formation->id);
        } else {
            $formation = new Formation;
            $formation->title = $request->title;
            $formation->description = $request->description;
            $formation->content = $request->content;

            $category = Category::find($request->category);
            $formation->categories()->attach($category);
            $formation->user_id = $request->author;
            $formation->save();

            return redirect()->route('formations.show', $formation->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation)
    {
        $classrooms    = Classroom::all();
        $sessions      = Session::all()->where('formation_id', $formation->id);
        $all_sessions  = Session::all();
        $user_sessions = array();
        $formations    = Formation::all();

        foreach ($formations->where('user_id', $formation->user->id) as $f)
        {
            foreach ($all_sessions->where('formation_id', $f->id) as $i)
            {
                array_push($user_sessions, $i);
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

        return view('formations.show', compact(
            'formation',
            'classrooms',
            'sessions',
            'all_sessions',
            'user_sessions',
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation)
    {
        $this->authorize('update', $formation);
        return view('formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation)
    {
        $this->authorize('update', $formation);

        $data = $request->validate([
            'title'       => 'required|min:3',
            'description' => 'required|min:10',
            'content'     => 'required|min:30'
        ]);

        $formation->update($data);

        return redirect()->route('formations.show', $formation->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        $this->authorize('update', $formation);

        Formation::destroy($formation->id);

        return redirect('/');
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
