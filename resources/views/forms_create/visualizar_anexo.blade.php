@extends('layout.cabecalho')

@section('titulo_pagina')
    Anexos
@endsection

@section('titulo')
    Visualizar Anexos
@endsection


@section('conteudo')

    @foreach($files as $file)
        <ul>
            <a href="{{ asset("storage/anexos/".$file->id_upload_codigo.'/'.$file->path)}}" class="btn btn-default" target="_blank">  {{$file->path}} </a>
        </ul>
    @endforeach

@endsection