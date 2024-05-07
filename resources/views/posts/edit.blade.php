@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categorias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Categorias</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-body">
                        @include('includes.alertas')
                        <form action="{{ url('/categorias/actualizar/' . $categoria->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" value="{{ $categoria->nombre }}" class="form-control">
                                @error('nombre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" name="imagen" class="form-control">
                                @error('imagen')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-center">
                                <img src="{{ $categoria->getImagenUrl() }}" height="80px">
                            </div>
                            <div class="text-center">

                                <a href="{{ url('/categorias') }}" class="btn btn-primary ">Volver al Listado </a>

                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
