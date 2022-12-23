@extends('layout.cabecalho')

@section('titulo_pagina')
    Editando Usuários
@endsection

@section('titulo')
    Altere sua senha Sr: {{$edit->login}}
@endsection

@section('conteudo')
<form action="{{route('alterar_senha')}}" method="POST">
  @method('PUT')
    @csrf
  <br>
  <br>
    <div class="row">



      <div class="col-md-3">
        <label><b>Login:</b></label>
        <label for="login"></label><input type="text" class="form-control" value="{{$edit->login}}" id="login" name="login" placeholder="" required disabled>
      </div>

      <div class="col-md-3">
        <label><b>Senha:</b></label>
        <label for="password"></label><input type="password" class="form-control"  id="#" name="#" placeholder="" required>
      </div>
  
      <div class="col-md-3">
        <label><b>Confirma Senha:</b></label>
        <label for="password"></label><input type="password" class="form-control"  id="password" name="password" placeholder="" required>
      </div>
  
    </div>
  
  <br>
  <br>
    <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Alterar</button><br>
  </form>
  <br>
  <br>

@endsection
