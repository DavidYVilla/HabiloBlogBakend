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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 text-end">
                            <a href="{{ url('/categorias/registrar') }}" class="btn btn-primary btn-sm">Nueva Categoria</a>
                        </div>
                    </div>
                    @include('includes.alertas')
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IMAGEN</th>
                                    <th>NOMBRE</th>
                                    <th>ESTADO</th>
                                    <th>USUARIO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td class="text-center">
                                            <img src="{{ $item->getImagenUrl() }}" alt="" class="bordered"
                                                height="40px">
                                        </td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>
                                            @if ($item->estado == true)
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->usuario->name }}</td>
                                        <td>
                                            <a href="{{ url('/categorias/actualizar/' . $item->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                                            </a>
                                            @if ($item->estado == true)
                                                <a href="{{ url('/categorias/estado/' . $item->id) }}"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-ban"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('/categorias/estado/' . $item->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-check"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categorias->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
