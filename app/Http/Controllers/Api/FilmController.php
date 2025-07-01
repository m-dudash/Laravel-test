<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::with('genres')->paginate(10);
        return response()->json($films);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'poster'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genres'=>'required|array'
        ]);

        $posterPath = $request->file('poster') ? $request->file('poster')->store('posters','public')
            : 'default.jpg';

        $film = Film::create([
           'title' => $request->title,
            'poster'=>$posterPath,
            'status'=>false,
        ]);

        $film->genres()->attach($request->genres);

        return response()->json(['message'=>'Film was created'], 201);
    }

    public function publish($id)
    {
        $film = Film::findOrFail($id);
        $film->update(['status'=>true]);
        return response()->json(['message'=>'Published'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Film::with('genres')->findOrFail($id);
        return response()->json($film);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $film = Film::findOrFail($id);

        $request->validate([
            'title'=>'required|string|max:255',
            'poster'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genres'=>'required|array'
        ]);

        $posterPath = $film->poster;
        if ($request->hasFile('poster')){
            if ($film->poster !== 'default.jpg'){
                Storage::disk('public')->delete($film->poster);
            }
            $posterPath = $request->file('poster')->store('posters','public');
        }

        $film->update([
           'title'=>$request->title,
            'poster'=>$posterPath
        ]);
        $film->genres()->sync($request->genres);

        return response()->json(['message'=>'Updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $film = Film::findOrFail($id);
        if($film->poster !== 'default.jpg'){
            Storage::disk('public')->delete($film->poster);
        }
        $film->genres()->detach();
        $film->delete();

        return response()->json(['message'=>'Film was deleted'], 200);
    }
}
