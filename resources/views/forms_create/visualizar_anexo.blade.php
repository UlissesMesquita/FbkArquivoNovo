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
                <a href="{{ asset("storage/anexos/".$file->id_upload_codigo.'/'.$file->path)}}" class="btn btn-default" target="_blank" style="color:blue">  {{$file->path}} </a> 
                <!-- <a id="delete-icon" class="fas fa-trash fa-1x" style="color:red" href="/documento/delete_anexo/{{$file->id_upload}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a> -->
            </ul>


            <tr>
                
            </tr>


    @endforeach

@endsection