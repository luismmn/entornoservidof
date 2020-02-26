<?php

namespace App\Http\Controllers;

use App\Carta;
use App\Edicione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CartaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $games = Game::all();

        $title = 'Listado de juegos';

        return view('games.index', compact('title', 'games'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function create()
    {

        $companies = Company::all();

        return view('games.create', compact('companies'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required','unique:games,name'],
            'genre' => 'required',
            'platform' => 'required',
            'company' => 'required',
            'release' => ['required','regex:/^\d{4}$/'],
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'genre.required' => 'El campo genero es obligatorio',
            'platform.required' => 'El campo plataforma es obligatorio',
            'company.required' => 'El campo empresa es obligatorio',
            'release.required' => 'El campo salida es obligatorio',
            'name.unique' => 'El nombre del juego ya esta en uso',
            'release.regex' => 'El formato del año no es el correcto'
        ]);

        Game::create([
            'name' => $data['name'],
            'genre' => $data['genre'],
            'platform' => $data['platform'],
            'company' => $data['company'],
            'release' => $data['release']
        ]);

        return redirect()->route('games.index');
    }

    public function edit(Game $game)
    {
        $companies = Company::all();

        return view('games.edit', ['game' => $game], compact('companies'));
    }

    public function update(Game $game)
    {
        $data = request()->validate([
            'name' => 'required',
            'genre' => 'required',
            'platform' => 'required',
            'company' => 'required',           
            'release' => ['required','regex:/^\d{4}$/'],
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'genre.required' => 'El campo genero es obligatorio',
            'platform.required' => 'El campo plataforma es obligatorio',
            'company.required' => 'El campo empresa es obligatorio',
            'release.required' => 'El campo salida es obligatorio',
            'release.regex' => 'El formato del año no es el correcto'            
        ]);

        $game->update($data);

        return redirect()->route('games.show', ['game' => $game]);
    }

    function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('cartas.index');
    }
}