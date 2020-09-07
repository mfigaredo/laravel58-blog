@extends('layout')
@section('content')

    <section class="pages container">
        <div class="page page-about">
            <h1 class="text-capitalize">Página no encontrada</h1>
            <p class="text-center" style="color:red !important;">

                <i class="fa fa-exclamation-triangle fa-5x"></i>
            </p>
            <p>Regresar al <a href="{{ route('pages.home') }}">inicio</a>.</p>
        </div>
    </section>
@endsection
