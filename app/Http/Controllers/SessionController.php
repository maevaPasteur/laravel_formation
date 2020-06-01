<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Session;
use App\Formation;
use App\SessionUser;
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
        //
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
        $formation = Formation::find($session->formation_id)->formation;
        $classroom = Formation::find($session->classroom_id);
        $date = date('d/m/Y', strtotime($session->start));

        $places_available = $session->classroom->places - $session->users->count();

        return view('sessions.show', compact('session', 'date', 'formation', 'classroom', 'places_available'));
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
        //
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
}
