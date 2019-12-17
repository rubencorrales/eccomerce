@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acceso candidatos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Te has conectado correctamente.
                        <br>
                        <a href="{{route('perfil')}}">Ir a tu perfil</a>
                        <br>
                        <a href="{{route('perfil')}}">Buscar ofertas de empleo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
