<?php

namespace App\Http\Controllers;

use App\Edicione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EdicioneController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ediciones = Edicione::all();

        $title = 'Listado de ediciones';

        return view('ediciones.index', compact('title', 'ediciones'));
    }

    public function show(Edicione $edicione)
    {
        return view('ediciones.show', compact('ediciones'));
    }

    public function create()
    {
        return view('ediciones.create');
    }

    public function store()
    {
        $data = request()->validate([
            'nombre_ediciones' => ['required','unique:ediciones,nombre_ediciones'],
            'color' => ['required','unique:ediciones,color','regex:/^[A-Z0-9]{2}$/'],
            'tipo' => ['required','regex:/^[A-ZÑ][a-zñ]+( [A-ZÑ][a-zñ]+)*$/'],
            'precio' => ['required','regex:/^\d{4}$/'],
        ], [
            'nombre_ediciones.required' => 'El campo nombre es obligatorio',
            'color.required' => 'El campo color es obligatorio',
            'tipo.required' => 'El campo tipo es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            
            'nombre_ediciones.unique' => 'El nombre de la edicion ya esta en uso',
            'color.unique' => 'El nombre de la color ya esta en uso',
           
            'color.regex' => 'El formato de la color no es el correcto',
            'tipo.regex' => 'El formato del tipo no es el correcto',
            'precio.regex' => 'El formato del precio no es el correcto',
            
        ]);

        Edicione::create([
            'nombre_ediciones' => $data['nombre_ediciones'],
            'color' => $data['color'],
            'tipo' => $data['tipo'],
            'precio' => $data['precio'],
            
        ]);

        return redirect()->route('ediciones.index');
    }

    public function edit(Edicione $edicione)
    {
        return view('ediciones.edit', ['edicione' => $edicione]);
    }

    public function update(Edicione $edicione)
    {
        $data = request()->validate([
            'nombre_ediciones' => 'required',
            'color' => ['required',Rule::unique('ediciones')->ignore($edicione->color),'regex:/^[A-Z0-9]{2}$/'],
            'tipo' => ['required','regex:/^[A-ZÑ][a-zñ]+( [A-ZÑ][a-zñ]+)*$/'],
            'precio' => ['required','regex:/^\d{4}$/'],
           
        ],[
            'nombre_ediciones.required' => 'El campo nombre es obligatorio',
            'color.required' => 'El campo color es obligatorio',
            'tipo.required' => 'El campo tipo es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
           
            'color.unique' => 'El nombre de la color ya esta en uso',
           
            'color.regex' => 'El formato de la color no es el correcto',
            'tipo.regex' => 'El formato del tipo no es el correcto',
            'precio.regex' => 'El formato  de precio no es el correcto',
           
        ]);

        $edicione->update($data);

        return redirect()->route('ediciones.show', ['ediciones' => $edicione]);
    }

    function destroy(Edicione $edicione)
    {
        $edicione->delete();

        return redirect()->route('ediciones.index');
    }
}