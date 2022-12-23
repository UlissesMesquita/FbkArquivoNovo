@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Editando Tipo de Documento
@endsection

@section('titulo')
    Editando Job: {{$edit->tp_documento}}
@endsection


@section('conteudo')
    <form action="{{route('tp_documento_update', $edit->id_tp_documento)}}" method="POST">
        @method('PUT')
        {{csrf_field()}}
        <div class=""><br>
            <label>Jobs:</label>
        <label for="tp_documento"></label><input type="text" class="form-control" id="tp_documento" autofocus name="tp_documento" placeholder="" value="{{$edit->tp_documento}}" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>

@endsection
