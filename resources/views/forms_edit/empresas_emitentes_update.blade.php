@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Editando Empresas Emitentes
@endsection

@section('titulo')
    Editando Empresa Emitente: {{$edit->cad_emitentes}}
@endsection


@section('conteudo')
    <form action="{{route('emitente_update', $edit->id_empresa_emitente)}}" method="POST">
        @method('PUT')
        {{csrf_field()}}
        <div class=""><br>
            <label>Empresas Emitentes:</label>
        <label for="cad_emitentes"></label><input type="text" autofocus class="form-control" id="cad_emitentes" name="cad_emitentes" placeholder="" value="{{$edit->cad_emitentes}}" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>

@endsection
