@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear Nuevo Empledo') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('empleado.update', $empleado) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder=""
                                    aria-describedby="helpId" value="{{isset($empleado->name) ? $empleado->name :  old('name')}}">
                                <small id="helpId" class="text-muted">Help text</small>
                            </div>

                            <div class="form-group">
                                <label for="">Apellido</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder=""
                                    aria-describedby="helpId" value="{{isset($empleado->lastname) ? $empleado->lastname :  old('lastname')}}">
                                <small id="helpId" class="text-muted">Help text</small>
                            </div>

                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder=""
                                    aria-describedby="helpId" value="{{ isset($empleado->email) ? $empleado->email : old('email')}}">
                                <small id="helpId" class="text-muted">Help text</small>
                            </div>

                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" name="photo" id="photo" class="form-control" placeholder=""
                                    aria-describedby="helpId" value="{{isset($empleado->photo) ? $empleado->getUrlPhoto() : old('photo')}}>
                                <small id="helpId" class="text-muted" ">Help text</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Editar</button>
                            <a class="btn btn-secondary" href="{{ route('empleado.index') }}" role="button">Regresar</a>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
