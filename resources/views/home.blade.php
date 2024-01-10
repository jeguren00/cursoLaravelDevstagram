@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    <x-listar-posts :posts="$posts"/>
@endsection