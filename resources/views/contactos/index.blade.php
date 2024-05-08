@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Contactos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Contactos</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    @include('includes.alertas')
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>CORREO</th>
                                    <th>ASUNTO</th>
                                    <th>MENSAJE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactos as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->correo }}</td>
                                        <td>{{ $item->asunto }}</td>
                                        <td>{{ $item->mensaje }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $contactos->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
