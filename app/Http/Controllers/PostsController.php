<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Posts;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Posts::with('usuario', 'categoria')->orderBy('id', 'DESC')->paginate(10);
        return view('posts.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categorias::where('estado', true)->get();
        $tags = Tags::where('estado', true)->get();

        return view('posts.create', compact('categorias', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'categoria_id' => 'required|exists:categorias,id',
            'titulo' => 'required|string|min:10|max:200',
            'imagen' => 'required|image|mimes:png,jpg,jpeg',
            'resumen' => 'required|string|min:5|max:350',
            'contenido' => 'required|string|min:5',
            'estado' => 'nullable',
            'tags' => 'nullable',
            'fecha_publicacion' => 'required'
        ]);

        if($request->file('imagen')){
            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('post_') . '.png';
            if(!is_dir(public_path('/imagenes/posts/'))){
                File::makeDirectory(public_path().'/imagenes/posts/',0777,true);
            }
            $subido = $imagen->move(public_path().'/imagenes/posts/', $nombreImagen);
        } else {
            $nombreImagen = 'default.png';
        }

        $post = new Posts();
        $post->categoria_id = $request->categoria_id;
        $post->titulo = $request->titulo;
        $post->imagen = $nombreImagen;
        $post->resumen = $request->resumen;
        $post->contenido = $request->contenido;
        $post->estado = ($request->estado == 'on') ? true : false;
        $post->tags = json_encode($request->tags);
        $post->fecha_publicacion = $request->fecha_publicacion;
        $post->usuario_id = auth()->user()->id;
        if ($post->save()) {
            return redirect('/posts')->with('success', 'Registro agregado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué realizado!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Posts::with('usuario', 'categoria', 'comentarios', 'comentarios.usuario')->find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Posts::find($id);

        // dd($post);

        $categorias = Categorias::where('estado', true)->get();
        $tags = Tags::where('estado', true)->get();

        return view('posts.edit', compact('post', 'categorias', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoria_id' => 'required|exists:categorias,id',
            'titulo' => 'required|string|min:10|max:200',
            'imagen' => 'nullable|image|mimes:png,jpg,jpeg',
            'resumen' => 'required|string|min:5|max:350',
            'contenido' => 'required|string|min:5',
            'estado' => 'nullable',
            'tags' => 'nullable',
            'fecha_publicacion' => 'required'
        ]);

        $post = Posts::find($id);

        if($request->file('imagen')){
            // eliminar la imagen anterior
            if($post->imagen != 'default.png'){
                if(file_exists(public_path().'/imagenes/posts/'.$post->imagen)){
                    unlink(public_path().'/imagenes/posts/'.$post->imagen);
                }
            }

            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('post_') . '.png';
            if(!is_dir(public_path('/imagenes/posts/'))){
                File::makeDirectory(public_path().'/imagenes/posts/',0777,true);
            }
            $subido = $imagen->move(public_path().'/imagenes/posts/', $nombreImagen);

            $post->imagen = $nombreImagen;
        }

        $post->categoria_id = $request->categoria_id;
        $post->titulo = $request->titulo;

        $post->resumen = $request->resumen;
        $post->contenido = $request->contenido;
        $post->estado = ($request->estado == 'on') ? true : false;
        $post->tags = json_encode($request->tags);
        $post->fecha_publicacion = $request->fecha_publicacion;
        $post->usuario_id = auth()->user()->id;
        if ($post->save()) {
            return redirect('/posts')->with('success', 'Registro actualizado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué actualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function estado($id)
    {
        $post = Posts::find($id);
        $post->estado = !$post->estado;
        if ($post->save()) {
            return redirect('/posts')->with('success', 'Estado actualizado correctamente!');
        } else {
            return back()->with('error', 'El estado no fué actualizado!');
        }
    }
}
