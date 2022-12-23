<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorDashboard;



//Rotas para Login
Route::prefix('/')->group(function () {
    Route::get('/', [ControladorLogin::class, 'index'])->name('index');
    Route::GET('/45b38db', [ControladorLogin::class, 'leave'])->name('leave');
    Route::POST('/', [ControladorLogin::class, 'create'])->name('valida-login');
    Route::GET('/senha', [ControladorLogin::class, 'paginaAlteraSenha'])->name('paginaAlterarSenha');
    Route::PUT('/senha', [ControladorLogin::class, 'alterarSenha'])->name('alterar_senha');
});

//Rotas Dashboard
Route::prefix('/dashboard')->group(function () {
    Route::GET('/dash', [ControladorDashboard::class, 'index'])->name('dashboard');
    Route::GET('/manual', [ControladorDashboard::class, 'manual'])->name('manual');
    Route::GET('/pdf/{name_pdf}', [ControladorDashboard::class, 'showPdf'])->name('pdf');
    Route::GET('/documentos_edit/{id}', [ControladorDashboard::class, 'edit'])->name('edit');
    Route::PUT('/documentos_update/{id}', [ControladorDashboard::class, 'update'])->name('update');
    Route::GET('/delete/{id}', [ControladorDashboard::class, 'destroy'])->name('delete_documento');
});

//Rotas Documentos
Route::prefix('documento')->group(function () {
    Route::GET('/', [ControladorDocumento::class, 'create'])->name('documentos_create');
    Route::POST('/novo', [ControladorDocumento::class, 'store'])->name('novo_documento');
    Route::POST('/anexo', [ControladorDocumento::class, 'show'])->name('visualizar_anexo');
    Route::GET('/edit_clone/{id}', [ControladorDocumento::class, 'edit_clone'])->name('edit_clone');
    Route::PUT('/clone', [ControladorDocumento::class, 'clone'])->name('clone');
});

//Rotas JOB
Route::prefix('job')->group(function () {
    Route::GET('/', 'ControladorJob@index')->name('job_index');
    Route::POST('/novo', 'ControladorJob@store')->name('novo_job');
    Route::GET('/delete/{id}', 'ControladorJob@destroy')->name('job_delete');
    Route::GET('/edit/{id}', 'ControladorJob@edit')->name('job_edit');
    Route::PUT('/update/{id}', 'ControladorJob@update')->name('job_update');
});

//Rotas Tipo de Documento
Route::prefix('tp_documento')->group(function () {
    Route::GET('/', 'ControladorTipoDocumento@index')->name('tp_documento_index');
    Route::POST('/novo', 'ControladorTipoDocumento@store')->name('novo_tp_documento');
    Route::GET('/delete/{id}', 'ControladorTipoDocumento@destroy')->name('tp_documento_delete');
    Route::GET('/edit/{id}', 'ControladorTipoDocumento@edit')->name('tp_documento_edit');
    Route::PUT('/update/{id}', 'ControladorTipoDocumento@update')->name('tp_documento_update');
});

//Rotas Departamentos
Route::prefix('departamento')->group(function () {
    Route::GET('/', 'ControladorDepartamento@index')->name('departamento_index');
    Route::POST('/novo', 'ControladorDepartamento@store')->name('novo_departamento');
    Route::GET('/delete/{id}', 'ControladorDepartamento@destroy')->name('departamento_delete');
    Route::GET('/edit/{id}', 'ControladorDepartamento@edit')->name('departamento_edit');
    Route::PUT('/update/{id}', 'ControladorDepartamento@update')->name('departamento_update');
});

//Rotas Origens
Route::prefix('origem')->group(function () {
    Route::GET('', 'ControladorOrigem@index')->name('origem_index');
    Route::POST('/novo', 'ControladorOrigem@store')->name('novo_origem');
    Route::GET('/delete/{id}', 'ControladorOrigem@destroy')->name('origem_delete');
    Route::GET('/edit/{id}', 'ControladorOrigem@edit')->name('origem_edit');
    Route::PUT('/update/{id}', 'ControladorOrigem@update')->name('origem_update');
});

//Rotas Emitentes
Route::prefix('emitente')->group(function () {
    Route::GET('', 'ControladorEmitente@index')->name('emitente_index');
    Route::POST('/novo', 'ControladorEmitente@store')->name('novo_emitente');
    Route::GET('/delete/{id}', 'ControladorEmitente@destroy')->name('emitente_delete');
    Route::GET('/edit/{id}', 'ControladorEmitente@edit')->name('emitente_edit');
    Route::PUT('/update/{id}', 'ControladorEmitente@update')->name('emitente_update');
});

//Rotas Destinatarias
Route::prefix('destinataria')->group(function () {
    Route::GET('/', 'ControladorDestinataria@index')->name('destinataria_index');
    Route::POST('/novo', 'ControladorDestinataria@store')->name('novo_destinataria');
    Route::GET('/delete/{id}', 'ControladorDestinataria@destroy')->name('destinataria_delete');
    Route::GET('/edit/{id}', 'ControladorDestinataria@edit')->name('destinatarias_edit');
    Route::PUT('/update/{id}', 'ControladorDestinataria@update')->name('destinataria_update');
});

//Rotas Para Pesquisas
Route::prefix('pesquisas')->group(function () {
    Route::GET('/', 'ControladorPesquisas@index')->name('pesquisa_index');
    Route::POST('/', 'ControladorPesquisas@show')->name('pesquisa_novo');
    Route::POST('/getPdf','ControladorPesquisas@getPdf')->name('pesquisa_getPdf');
});

//Rotas Para Configurações de usuários
Route::prefix('config')->group(function () {
    Route::GET('/d1sc73637da336815574f515c222f7a28095c880d4d37823455c99928caceb680', 'ControladorLogin@show')->name('configuracoes-usuarios');
    Route::GET('/o2173637da3368asdac222f7a28095c880d4d37823455c99928cb680/delete/{id}', 'ControladorLogin@destroy')->name('usuarios-delete');
    Route::POST('/i3173637da336815574f515casdf7a28095c880d4d37823455c99928caceb680', 'ControladorLogin@store')->name('create-store');
    Route::GET('/2o973637da33681557asdas22f7a28095c880d4d37823455c99928c1a3c3e4b680/edit/{id}', 'ControladorLogin@edit')->name('usuarios-edit');
    Route::PUT('/is973637da3asdasd15c222f7a28095c880d4d37823455c99928c1a2680/update/{id}', 'ControladorLogin@update')->name('usuarios-update');
});

//Rotas para Caixas
Route::prefix('caixas')->group(function () {
    Route::GET('/','ControladorCaixasDepartamento@index')->name('caixas');
    Route::POST('/novo', 'ControladorCaixasDepartamento@store')->name('nova_caixa');
    Route::GET('/abrir/{id}', 'ControladorCaixasDepartamento@abrirCaixa')->name('abrir_caixa');
    Route::GET('/fechar/{id}', 'ControladorCaixasDepartamento@fecharCaixa')->name('fechar_Caixa');
    Route::GET('/edit/{id}', 'ControladorCaixasDepartamento@edit')->name('caixa_edit');
    Route::PUT('/update/{id}', 'ControladorCaixasDepartamento@update')->name('caixa_update');
});