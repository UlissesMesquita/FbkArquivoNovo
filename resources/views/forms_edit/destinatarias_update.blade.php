@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Alterando Empresas Destinatárias
@endsection

@section('titulo')
    Alterando Empresa Destinatária:
@endsection

@section('conteudo')
<form method="POST" action="{{route('destinataria_update', $edit->id_empresa_destinataria)}}" >
        @method('PUT')
        @csrf
        <div class=""><br>
            <label>Empresas Destinatarias:</label>
        <label for="cad_destinatarias"></label><input type="text" autofocus class="form-control" id="cad_destinatarias" name="cad_destinatarias" placeholder="" value="{{$edit->cad_destinatarias}}" required onkeyup="maiuscula(this)"
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>
@endsection


