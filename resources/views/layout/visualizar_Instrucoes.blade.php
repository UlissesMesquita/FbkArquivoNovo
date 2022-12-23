@extends('layout.cabecalho')

@section('titulo_pagina')
    Manuais do Sistema
@endsection

@section('titulo')
    Manuais do Sistema
@endsection


@section('conteudo')

        {{-- Manual do Sistema --}}
        <ul>
            <a href="{{asset("storage/Manual_Sistema_SisFBK.pdf")}}" target="_blank"> Manual do Sistema </a>
        </ul>
        
        {{-- Método Conceito de Arquivo --}}
        <ul>
            <a href="{{asset("storage/Metodo_Conceito_de_Arquivo.pdf")}}" target="_blank"> Método Conceito de Arquivo </a>
        </ul>    
    

@endsection