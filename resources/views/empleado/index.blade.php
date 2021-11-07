@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Listado de Empledos') }}
                    <a name="" id="" class="btn btn-primary" href="{{route('empleado.create')}}" role="button">Nuevo Empledo</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados as $e)
                            <tr>
                                <td  scope="row"><img class="img-fluid img-thumbnail" width="100px" src="{{$e->getUrlPhoto()}}" alt="{{$e->name}}"></td>
                                <td>{{$e->name}}</td>
                                <td>{{$e->lastname}}</td>
                                <td>{{$e->email}}</td>
                                <td>
                                    <form action="{{route('empleado.edit', $e)}}" method="POST">
                                        @csrf
                                        @method('GET')
                                        <input name="editar" id="editar" class="btn btn-warning" type="submit" value="Editar"> | 
                                    </form>
                                    <form action="{{route('empleado.destroy', $e)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input name="eliminar" id="eliminar" class="btn btn-danger" type="submit" value="Eliminar">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{$empleados->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
