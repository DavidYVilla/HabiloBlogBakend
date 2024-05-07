@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Posts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end">
                                <a href="{{ url('/posts') }}" class="btn btn-primary btn-sm">Volver al listado</a>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <b>USUARIO:</b> {{ $post->usuario->name }}
                                    <br>
                                    <b>ESTADO: </b> {{ $post->estado == true ? 'Publicado' : 'Borrador' }}
                                </div>
                                <div class="col-md-6">
                                    <b>FECHA DE PUBLICACIÓN: </b> {{ $post->fecha_publicacion }}
                                    <br>
                                    <b>FECHA DE CREACIÓN: </b>{{ $post->created_at }}
                                </div>
                            </div>

                            <div class="text-center">
                                <h3>{{ $post->titulo }}</h3>

                                <img src="{{ $post->getImagenUrl() }}" alt="" class="border" height="250px">
                            </div>

                            <div class="mt-3">
                                <h4>RESUMEN: </h4>

                                {{ $post->resumen }}
                            </div>

                            <div class="mt-3">
                                <h4>CONTENIDO: </h4>

                                <p style="text-wrap: wrap !important;">
                                    {!! $post->contenido !!}
                                </p>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3>COMENTARIOS DEL POST</h3>

                            <table class="table table-borderless">
                                @foreach ($post->comentarios as $com)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Usuario: </b> {{ $com->usuario->name }}
                                                </div>
                                                <div class="col-md-6">
                                                    {{ $com->fecha }}
                                                </div>
                                            </div>
                                            <br>
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    {{ $com->comentario }}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
