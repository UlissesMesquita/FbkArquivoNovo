@if(session()->get('autenticado') != 1)
<meta http-equiv="refresh" content="0;URL='/'"/>
@endif 



<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/cabecalho.css')}}">
    <link rel="stylesheet" href="{{asset('css/Stylesheet.css')}}">


    <link rel="stylesheet" href="{{asset('css/fontawesome/css/all.css')}}">

    <meta charset="utf-8">
        <title>@yield('titulo_pagina')</title>


</head>


<body>

    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/JQuery.js')}}"></script><!--Versão 3.1.0-->
    <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jsPersonalizado.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/upper.js')}}"></script>

    <script src="{{asset('js/Javascript.js')}}"></script>


        <!-- Logotipo - Fabrika Filmes -->
        <div class="navbar1">
                {{-- <a href="{{route('dashboard')}}"><i class="fas fa-industry">  Fabrika Filmes</i></a> --}}

        <!-- Inserir Documentos -->
                <a href="{{route('documentos_create')}}">Inserir Documentos</a>




            <!-- Cadastros -->
            <div class="dropdown1">
                    <button class="dropbtn1">Cadastros</button>
                    <div class="dropdown-content1">
                        {{-- <a href="{{route('documentos_create')}}">Documentos</a> --}}
                        <a href="{{route('job_index')}}">JOB</a>
                        <a href="{{route('tp_documento_index')}}">Tipo de Documentos</a>
                        <a href="{{route('emitente_index')}}">Empresas Emitentes</a>
                        <a href="{{route(('destinataria_index'))}}">Empresas Destinatárias</a>
                        <a href="{{route('origem_index')}}">Origens</a>
                    @if(session()->get('permissao') == 'Admin')
                        <a href="{{route('departamento_index')}}">Departamentos</a>
                    @endif
                    @if(session()->get('permissao') == 'Admin')
                        <a href="{{route('caixas')}}">Caixas</a>
                    @endif
                    </div>
            </div>

            <!-- Pesquisas -->
            <div class="dropdown1">
                <button class="dropbtn1">Pesquisas</button>
                    <div class="dropdown-content1">
                        <a href="{{route('pesquisa_index')}}">Pesquisa Geral</a>
                </div>
            </div>

        @if(session()->get('permissao') == 'Admin')
            <!-- Relatórios -->
            <div class="dropdown1">
                <button class="dropbtn1">Relatórios</button>
                    <div class="dropdown-content1">
                        <a href="{{route('relatorio_index')}}">Relatório Geral</a>
                </div>
            </div>
        @endif
            
        @if(session()->get('permissao') == 'Admin')
            <!-- Configurações -->
            <div class="dropdown1">
            <button class="dropbtn1">Configurações</button>
                <!-- Usuarios -->
                <div class="dropdown-content1">
                    <a href="{{route('configuracoes-usuarios')}}">Usuários</a>
                </div>
            </div>
            
        @endif

            <!-- Sair -->
            <div class="dropdownExit1">
                <a href="{{route('leave')}}">Sair</a>
            </div>

            <!-- Alterar Senha -->
            <div class="dropdownExit1">
                <a href="{{route('alterar_senha')}}">Alterar Senha</a>
            </div>

           <!-- Instruções do Sistema -->
            <div class="dropdownExit1">
                <a href="{{route('manual')}}">Instruções Sistema</a>
            </div>




            


            
        </div>

    <!-- Template -->
        <h1>@yield('titulo')</h1>


        <div class="container-fluid">
            @yield('conteudo')
        </div>    

            
        </div>


        <footer>
            <b>©Controle de Arquivo Fabrika</b> Versão 1.0
            <br>
            Desenvolvido por <b>Ulisses Mesquita</b> 
            <br>
            Autorizado para Fabrika Filmes
        </footer>
        </div>


</body>
</html>



