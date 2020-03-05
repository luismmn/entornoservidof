@extends('layout')

@section('title', 'No Admin')

@section('content')
<div>
    <h1>Solo el administrador puede realizar funciones de crear, editar y eliminar</h1>
</div> 
@endsection

@section('sidebar')
    @parent
@endsection