<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comentarios = Comentarios::with('usuario', 'post')->orderBy('id', 'DESC')->paginate(10);

        return view('comentarios.index', compact('comentarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($post_id)
    {
        return view('comentarios.create', compact('post_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'comentario' => 'required|string|min:10|max:200'
        ]);

        $comment = new Comentarios();
        $comment->post_id = $post_id;
        $comment->comentario = $request->comentario;
        $comment->estado = true;
        $comment->fecha = now();
        $comment->usuario_id = auth()->user()->id;
        if ($comment->save()) {
            return redirect('/comentarios')->with('success', 'Registro agregado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué realizado!');
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
        $comentario = Comentarios::find($id);

        return view('comentarios.edit', compact('comentario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'comentario' => 'required|string|min:10|max:200'
        ]);

        $comment = Comentarios::find($id);
        $comment->comentario = $request->comentario;
        $comment->estado = true;
        $comment->fecha = now();
        $comment->usuario_id = auth()->user()->id;
        if ($comment->save()) {
            return redirect('/comentarios')->with('success', 'Registro actualizado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué actualizado!');
        }
    }

    public function estado($id)
    {
        $comment = Comentarios::find($id);
        $comment->estado = !$comment->estado;
        if ($comment->save()) {
            return redirect('/comentarios')->with('success', 'Estado actualizado correctamente!');
        } else {
            return back()->with('error', 'El estado no fué actualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
