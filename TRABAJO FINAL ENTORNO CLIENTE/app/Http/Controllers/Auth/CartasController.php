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
        $cartas = Carta::all();

        $title = 'Listado de cartas';

        return view('cartas.index', compact('title', 'cartas'));
    }

    public function show(Cartas $carta)
    {
        return view('cartas.show', compact('carta'));
    }

    public function create()
    {

        $ediciones = Edicione::all();

        return view('cartas.create', compact('ediciones'));
    }

    public function store()
    {
        $data = request()->validate([
            'nombre_carta' => ['required','unique:cartas,nombre_carta'],
            'color' => 'required',
            'tipo' => 'required',
            'precio' => 'required',
            
        ], [
            'nombre_carta.required' => 'El campo nombre es obligatorio',
            'color.required' => 'El campo color es obligatorio',
            'tipo.required' => 'El campo tipo es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            'nombre_carta.unique' => 'El nombre de la carta ya esta en uso',
            
        ]);

        Game::create([
            'nombre_carta' => $data['nombre_carta'],
            'color' => $data['color'],
            'tipo' => $data['tipo'],
            'precio' => $data['precio'],
            
        ]);

        return redirect()->route('cartas.index');
    }

    public function edit(Cartas $carta)
    {
        $ediciones = Edicion::all();

        return view('cartas.edit', ['carta' => $carta], compact('ediciones'));
    }

    public function update(Carta $carta)
    {
        $data = request()->validate([
            'name' => 'required',
            'color' => 'required',
            'tipo' => 'required',
            'precio' => 'precio',           
            
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'color.required' => 'El campo color es obligatorio',
            'tipo.required' => 'El campo tipo es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
                    
        ]);

        $carta->update($data);

        return redirect()->route('cartas.show', ['carta' => $carta]);
    }

    function destroy(Carta $carta)
    {
        $carta->delete();

        return redirect()->route('cartas.index');
    }
}