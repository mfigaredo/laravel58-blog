@extends('layout')
@section('content')

    <section class="pages container">
        <div class="page page-about">
            <h1 class="text-capitalize">Página no autorizada.</h1>
            <p class="text-center" style="color:red !important;">

                <i class="fa fa-exclamation-circle fa-5x"></i>
            </p>
            <p>Regresar al <a href="{{ route('pages.home') }}">inicio</a>.</p>
            <p><i class="fa fa-arrow-left"></i> <a href="{{ url()->previous() }}">Atrás</a>.</p>
        </div>
    </section>
@endsection
