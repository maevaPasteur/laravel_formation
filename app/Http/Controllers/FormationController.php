<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Formation;
use App\Session;
use App\Category;
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
        $formations = Formation::latest()->paginate(10);

        return view('formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('formations.create', compact('categories'));
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
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'content' => 'required|min:30'
        ]);
        $formation = auth()->user()->formations()->create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content
        ]);

        $category = Category::find($request->category);
        $formation->categories()->attach($category);

        return redirect()->route('formations.show', $formation->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation)
    {
        $classrooms = Classroom::all();
        $sessions = Session::all()->where('formation_id', $formation->id);
        $all_sessions = Session::all();

        return view('formations.show', compact('formation', 'classrooms', 'sessions', 'all_sessions'));
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
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'content' => 'required|min:30'
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
}
