<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Auth::user()->categorias;
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ]
        ], [
            'nombre.unique' => 'Ya tienes una categoría con este nombre.'
        ]);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|required|max:500',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'descripcion.max' => 'La descripción no debe exceder los 500 caracteres.',
            'nombre.unique' => 'Ya existe una categoría con este nombre.',
            'descripcion.required' => 'La descripción es obligatoria.',
        ]);

        $categoria = new Categoria($validatedData);
        $categoria->user_id = Auth::id();
        $categoria->save();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })->ignore($categoria->id)
            ],
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'nombre.unique' => 'Ya tienes una categoría con este nombre.',
            'descripcion.max' => 'La descripción no debe exceder los 500 caracteres.',
        ]);

        $categoria->update($validatedData);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }
}
