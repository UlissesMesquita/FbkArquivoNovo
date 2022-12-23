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
Route::get('/', [ControladorLogin::class, 'index'])->name('index');
Route::GET('/45b38db', [ControladorLogin::class, 'leave'])->name('leave');
Route::POST('/', [ControladorLogin::class, 'create'])->name('valida-login');
Route::GET('/senha', [ControladorLogin::class, 'paginaAlteraSenha'])->name('paginaAlterarSenha');
Route::PUT('/senha', [ControladorLogin::class, 'alterarSenha'])->name('alterar_senha');


//Rotas Dashboard
Route::GET('/manual', [ControladorDashboard::class, 'manual'])->name('manual');
Route::GET('/dash', 'ControladorDashboard@index')->name('dashboard');
Route::GET('/pdf/{name_pdf}', 'ControladorDashboard@showPdf')->name('pdf');
Route::GET('/documentos_edit/{id}', 'ControladorDashboard@edit')->name('edit');
Route::PUT('/documentos_update/{id}', 'ControladorDashboard@update')->name('update');
Route::GET('/delete/{id}', 'ControladorDashboard@destroy')->name('delete_documento');

//Rotas Documentos
Route::GET('/documento', 'ControladorDocumento@create')->name('documentos_create');
Route::POST('/documento/novo', 'ControladorDocumento@store')->name('novo_documento');
Route::POST('/documento/anexo', 'ControladorDocumento@show')->name('visualizar_anexo');
Route::GET('/documento/edit_clone/{id}', 'ControladorDocumento@edit_clone')->name('edit_clone');
Route::PUT('/documento/clone', 'ControladorDocumento@clone')->name('clone');

//Rotas JOB
Route::GET('/job', 'ControladorJob@index')->name('job_index');
Route::POST('/job/novo', 'ControladorJob@store')->name('novo_job');
Route::GET('/job/delete/{id}', 'ControladorJob@destroy')->name('job_delete');
Route::GET('/job/edit/{id}', 'ControladorJob@edit')->name('job_edit');
Route::PUT('/job/update/{id}', 'ControladorJob@update')->name('job_update');

//Rotas Tipo de Documento
Route::GET('/tp_documento', 'ControladorTipoDocumento@index')->name('tp_documento_index');
Route::POST('/tp_documento/novo', 'ControladorTipoDocumento@store')->name('novo_tp_documento');
Route::GET('/tp_documento/delete/{id}', 'ControladorTipoDocumento@destroy')->name('tp_documento_delete');
Route::GET('/tp_documento/edit/{id}', 'ControladorTipoDocumento@edit')->name('tp_documento_edit');
Route::PUT('/tp_documento/update/{id}', 'ControladorTipoDocumento@update')->name('tp_documento_update');

//Rotas Departamentos
Route::GET('/departamento', 'ControladorDepartamento@index')->name('departamento_index');
Route::POST('/departamento/novo', 'ControladorDepartamento@store')->name('novo_departamento');
Route::GET('/departamento/delete/{id}', 'ControladorDepartamento@destroy')->name('departamento_delete');
Route::GET('/departamento/edit/{id}', 'ControladorDepartamento@edit')->name('departamento_edit');
Route::PUT('/departamento/update/{id}', 'ControladorDepartamento@update')->name('departamento_update');

//Rotas Origens
Route::GET('/origem', 'ControladorOrigem@index')->name('origem_index');
Route::POST('/origem/novo', 'ControladorOrigem@store')->name('novo_origem');
Route::GET('/origem/delete/{id}', 'ControladorOrigem@destroy')->name('origem_delete');
Route::GET('/origem/edit/{id}', 'ControladorOrigem@edit')->name('origem_edit');
Route::PUT('/origem/update/{id}', 'ControladorOrigem@update')->name('origem_update');

//Rotas Emitentes
Route::GET('/emitente', 'ControladorEmitente@index')->name('emitente_index');
Route::POST('/emitente/novo', 'ControladorEmitente@store')->name('novo_emitente');
Route::GET('/emitente/delete/{id}', 'ControladorEmitente@destroy')->name('emitente_delete');
Route::GET('/emitente/edit/{id}', 'ControladorEmitente@edit')->name('emitente_edit');
Route::PUT('/emitente/update/{id}', 'ControladorEmitente@update')->name('emitente_update');

//Rotas Destinatarias
Route::GET('/destinataria', 'ControladorDestinataria@index')->name('destinataria_index');
Route::POST('/destinataria/novo', 'ControladorDestinataria@store')->name('novo_destinataria');
Route::GET('/destinataria/delete/{id}', 'ControladorDestinataria@destroy')->name('destinataria_delete');
Route::GET('/destinataria/edit/{id}', 'ControladorDestinataria@edit')->name('destinatarias_edit');
Route::PUT('/destinataria/update/{id}', 'ControladorDestinataria@update')->name('destinataria_update');

//Rotas Para Pesquisas
Route::GET('/pesquisas', 'ControladorPesquisas@index')->name('pesquisa_index');
Route::POST('/pesquisas', 'ControladorPesquisas@show')->name('pesquisa_novo');
Route::POST('/pesquisas/getPdf','ControladorPesquisas@getPdf')->name('pesquisa_getPdf');

//Rotas Para Configurações de usuários
Route::GET('/config/d1sc73637da336815574f515c222f7a28095c880d4d37823455c99928caceb680', 'ControladorLogin@show')->name('configuracoes-usuarios');
Route::GET('/config/o2173637da3368asdac222f7a28095c880d4d37823455c99928cb680/delete/{id}', 'ControladorLogin@destroy')->name('usuarios-delete');
Route::POST('/config/i3173637da336815574f515casdf7a28095c880d4d37823455c99928caceb680', 'ControladorLogin@store')->name('create-store');
Route::GET('/config/2o973637da33681557asdas22f7a28095c880d4d37823455c99928c1a3c3e4b680/edit/{id}', 'ControladorLogin@edit')->name('usuarios-edit');
Route::PUT('/config/is973637da3asdasd15c222f7a28095c880d4d37823455c99928c1a2680/update/{id}', 'ControladorLogin@update')->name('usuarios-update');

//Rotas para Caixas
Route::GET('/caixas','ControladorCaixasDepartamento@index')->name('caixas');
Route::POST('/caixas/novo', 'ControladorCaixasDepartamento@store')->name('nova_caixa');
Route::GET('/caixas/abrir/{id}', 'ControladorCaixasDepartamento@abrirCaixa')->name('abrir_caixa');
Route::GET('/caixas/fechar/{id}', 'ControladorCaixasDepartamento@fecharCaixa')->name('fechar_Caixa');
Route::GET('/caixas/edit/{id}', 'ControladorCaixasDepartamento@edit')->name('caixa_edit');
Route::PUT('/caixas/update/{id}', 'ControladorCaixasDepartamento@update')->name('caixa_update');