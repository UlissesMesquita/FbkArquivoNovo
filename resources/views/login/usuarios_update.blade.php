@extends('layout.cabecalho')

@section('titulo_pagina')
    Editando Usuários
@endsection

@section('titulo')
    Editando o Usuário: {{$edit->login}}
@endsection

@section('conteudo')
<form action="{{route('usuarios-update', $edit->id_usuario)}}" method="POST">
  @method('PUT')
    @csrf
  <br>
  <br>
    <div class="row">

    <div class="col-md-1">
        <label><b>ID:</b></label>
        <label for="ID"></label><input type="text" class="form-control" value="{{$edit->id_usuario}}" id="id_usuario" name="id_usuario" value="{{$edit->id_usuario}}" disabled >
    </div>
  
      <div class="col-md-3">
        <label><b>Login:</b></label>
        <label for="login"></label><input type="text" class="form-control" value="{{$edit->login}}" id="login" name="login" placeholder="" required>
      </div>

      <div class="col-md-2">
        <label><b>Permissão: *</b></label>
        <label for="permissao"></label>
            <select id="permissao" name="permissao" class="form-control" required>
                  <option selected>{{$edit->permissao}}</option>
                    <option>Admin</option>
                    <option>Operador</option>
            </select>
      </div>

      <div class="col-md-3">
        <label><b>Departamento: *</b></label>
        <label for="departamento"></label>
            <select id="departamento" name="departamento" class="form-control" required>
                  <option selected>{{$edit->departamento}}</option>
                    @if(isset($dep))
                      @foreach($dep as $departamento)
                          <option value="{{$departamento->cad_departamento}}">{{$departamento->cad_departamento}}</option>
                      @endforeach
                      @endif
            </select>
      </div>

        <div class="col-md-2">
          <label><b>Ativo:*</b></label>
          <label for="permissao"></label>
              <select id="ativo" name="ativo" class="form-control" required>
                    <option selected>{{$edit->ativo}}</option>
                      <option>Ativo</option>
                      <option>Inativo</option>
              </select>
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
