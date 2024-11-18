<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Categoria $categoria)
    {
       // Obtener los productos de la categoría seleccionada
        $productos = $categoria->productos;
        

        // Devolver la vista con los productos de esa categoría
        return view('categorias.productos.index', compact('categoria', 'productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($categoriaId)
    {
        $categoria = Categoria::findOrFail($categoriaId);
        return view('categorias.productos.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $categoriaId)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('productos')->where(function ($query) use ($categoriaId) {
                    return $query->where('categoria_id', $categoriaId)
                                ->where('user_id', auth()->id());
                })
            ],
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:500',
            'stock_minimo' => 'nullable|integer|min:1'
        ], [
            'nombre.unique' => 'Ya existe un producto con este nombre en esta categoría.'
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $categoriaId;
        $producto->user_id = auth()->id();
        $producto->stock = 0;
        $producto->stock_minimo = $request->stock_minimo ?? 5; // Valor por defecto: 5
        $producto->save();

        return redirect()->route('productos.index', $categoriaId)
        ->with('success', 'Producto agregado exitosamente.');    }

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
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('categorias.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('productos')->where(function ($query) use ($producto) {
                    return $query->where('categoria_id', $producto->categoria_id)
                               ->where('user_id', auth()->id());
                })->ignore($producto->id)
            ],
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.unique' => 'Ya existe un producto con este nombre en esta categoría.'
        ]);

        $producto->update([
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'descripcion' => $request->input('descripcion'),
        ]);

        // Redirigir a la lista de productos después de actualizar
        return redirect()->route('productos.index', $producto->categoria_id)
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);

        $categoriaId = $producto->categoria_id;
        $producto->delete();

        // Redirigir a la lista de productos de la categoría después de eliminar
        return redirect()->route('productos.index', $categoriaId)
            ->with('success', 'Producto eliminado correctamente');
    }

    public function allProducts()
    {
        $productos = Producto::where('user_id', auth()->id())
                            ->with('categoria')
                            ->orderBy('nombre')
                            ->get();
        
        return view('categorias.productos.todosProductos', compact('productos'));
    }

}
