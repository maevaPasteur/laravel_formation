<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Formation;
use App\Session;
use App\User;
use Illuminate\Http\Request;

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
        $user = auth()->user();
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
        return view('profile.index', compact('user', 'formations', 'sessions', 'classrooms', 'all_formations'));
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

}
