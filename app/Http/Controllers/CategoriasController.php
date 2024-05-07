<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = Categorias::with('usuario')->orderby('id','DESC')->paginate(10);
        //dd($categorias);
        return view ('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $this->validate($request,[
        'nombre' => 'required|unique:categorias',
        'imagen' => 'nullable|image|mimes:png,jpg,jpeg',
       ]);
       if ($request->file('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('categoria_').'.png';
            $imagen->move(public_path().'/imagenes/categorias/',$nombreImagen);
       } else{
        $nombreImagen = 'default.png';
       }
       $categoria = new Categorias();
       $categoria->nombre = $request->nombre;
       $categoria->imagen = $nombreImagen;
       $categoria->estado = true;
       $categoria->usuario_id = auth()->user()->id;
       if ($categoria->save()) {
            return redirect('/categorias')->with('success','Registro agregado correctamente!');
       } else {
            return back()->with('error','El registro no fue realizado!');
       }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $categoria = Categorias::find($id);
        return view('categorias.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
        'nombre' => 'required|unique:categorias,nombre,'.$id,
        'imagen' => 'nullable|image|mimes:png,jpg,jpeg',
       ]);
       $categoria = Categorias::find($id);
       if ($request->file('imagen')) {
        //eliminar la imagen anterior
            if ($categoria->imagen != 'default.png') {
                if (file_exists(public_path().'/imagenes/categorias/'.$categoria->imagen)) {
                    unlink(public_path().'/imagenes/categorias/'.$categoria->imagen);
                }
            }
            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('categoria_').'.png';
            $imagen->move(public_path().'/imagenes/categorias/',$nombreImagen);
            $categoria->imagen = $nombreImagen;
       }

       $categoria->nombre = $request->nombre;
       $categoria->estado = true;
       $categoria->usuario_id = auth()->user()->id;
       if ($categoria->save()) {
            return redirect('/categorias')->with('success','Registro actualizado correctamente!');
       } else {
            return back()->with('error','El registro no fue actualizado!');
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function estado($id)
    {
        //
        $categoria = Categorias::find($id);
        $categoria->estado = !$categoria->estado;
        if ($categoria->save()) {
            return redirect('/categorias')->with('success','Estado actualizado correctamente!');
       } else {
            return back()->with('error','El estado no fue actualizado!');
       }
    }
}
