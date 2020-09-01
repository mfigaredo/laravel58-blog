@extends('admin.layout')
@section('page_title', 'Dashboard')
@section('content')
    <h1>Dashboard</h1>
    <p>Usuario autenticado: {{ auth()->user()->email }}</p>
@endsection
