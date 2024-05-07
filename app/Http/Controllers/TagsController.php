<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tags = Tags::with('usuario')->orderby('id','DESC')->paginate(10);
        //dd($tags);
        return view ('tags.index', compact('tags'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
        'nombre' => 'required|unique:tags',
       ]);

       $tag = new Tags();
       $tag->nombre = $request->nombre;
       $tag->estado = true;
       $tag->usuario_id = auth()->user()->id;
       if ($tag->save()) {
            return redirect('/tags')->with('success','Registro agregado correctamente!');
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
         $tag = Tags::find($id);
        return view('tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
        'nombre' => 'required|unique:categorias,nombre,'.$id,
       ]);
       $tag = Tags::find($id);
       $tag->nombre = $request->nombre;
       $tag->estado = true;
       $tag->usuario_id = auth()->user()->id;
       if ($tag->save()) {
            return redirect('/tags')->with('success','Registro actualizado correctamente!');
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
        $tag = Tags::find($id);
        $tag->estado = !$tag->estado;
        if ($tag->save()) {
            return redirect('/tags')->with('success','Estado actualizado correctamente!');
       } else {
            return back()->with('error','El estado no fue actualizado!');
       }
    }
}
