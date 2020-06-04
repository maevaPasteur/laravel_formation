<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Session;
use App\Formation;
use App\SessionUser;
use App\User;
use Carbon;
use DB;
use Illuminate\Http\Request;

class SessionController extends Controller
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
        $sessions = Session::latest()->paginate(9);
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Formation $formation)
    {
        $session = new Session;
        $session->classroom_id = $request->classroom_id;
        $session->start = $request->start;
        $session->formation_id = $formation->id;
        $session->open = 1;
        $session->save();

        return redirect()->route('formations.show', $formation->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        $formation = $session->formation;
        $classroom = $session->classroom;
        $date = $session->start;
        $date_beautify = date('d/m/Y', strtotime($date));
        $current_time = Carbon\Carbon::now()->toDateString();
        $teacher = User::all()->where('id', $formation->user_id)->first();

        $places_available = $session->classroom->places - $session->users->count();

        return view('sessions.show', compact('session', 'date', 'formation', 'classroom', 'places_available', 'date_beautify', 'current_time', 'teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $formation = $session->formation;
        $this->authorize('delete', $session);

        Session::destroy($session->id);

        return redirect()->route('formations.show', $formation);
    }

    /**
     * S'inscrire à une session
     */
    public function inscription(Session $session) {
        $session_user = new SessionUser;
        $session_user->session_id = $session->id;
        $session_user->user_id = auth()->user()->id;
        $session_user->save();

        return redirect()->route('sessions.show', $session->id);
    }

    /**
     * Ajouter et modifier les notes des élèves pour une session.
     */
    public function updateNote(Request $request, Session $session)
    {
        foreach($session->users as $user) {
            $note = $request->input("note_$user->id");
            if($note != null) {
                DB::table('session_user')
                ->where('user_id', $user->id)
                ->where('session_id', $session->id)
                ->update(array('note' => $note));
            }
        }

        return redirect()->route('sessions.show', $session->id);
    }


}
