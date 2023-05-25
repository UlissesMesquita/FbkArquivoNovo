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
use App\Http\Controllers\ControladorDocumento;
use App\Http\Controllers\ControladorJob;
use App\Http\Controllers\ControladorTipoDocumento;
use App\Http\Controllers\ControladorDepartamento;
use App\Http\Controllers\ControladorOrigem;
use App\Http\Controllers\ControladorEmitente;
use App\Http\Controllers\ControladorDestinataria;
use App\Http\Controllers\ControladorPesquisas;
use App\Http\Controllers\ControladorCaixasDepartamento;
use App\Http\Controllers\ControladorRelatorio;
use App\Http\Controllers\ControladorRotas;

//Rota Teste
Route::get('/teste', function(){
    return phpinfo();
});

//Rotas para Login
Route::prefix('/')->group(function () {
    Route::GET('/', [ControladorLogin::class, 'index'])->name('index');
    Route::GET('/45b38db', [ControladorLogin::class, 'leave'])->name('leave');
    Route::POST('/', [ControladorLogin::class, 'create'])->name('valida-login');
    Route::GET('/senha', [ControladorLogin::class, 'paginaAlteraSenha'])->name('paginaAlterarSenha');
    Route::PUT('/senha', [ControladorLogin::class, 'alterarSenha'])->name('alterar_senha');
});

//Rotas Para Configurações de usuários
Route::prefix('config')->group(function () {
    Route::GET('/', [ControladorLogin::class, 'show'])->name('configuracoes-usuarios');
    Route::GET('/delete/{id}', [ControladorLogin::class, 'destroy'])->name('usuarios-delete');
    Route::POST('/', [ControladorLogin::class, 'store'])->name('create-store');
    Route::GET('/edit/{id}', [ControladorLogin::class, 'edit'])->name('usuarios-edit');
    Route::PUT('/update/{id}', [ControladorLogin::class, 'update'])->name('usuarios-update');
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
    Route::GET('/delete_anexo/{id_upload}', [ControladorDocumento::class, 'deleteAnexo'])->name('deleteAnexo');
    Route::GET('/edit_clone/{id}', [ControladorDocumento::class, 'edit_clone'])->name('edit_clone');
    Route::PUT('/clone', [ControladorDocumento::class, 'clone'])->name('clone');
});

//Rotas JOB
Route::prefix('job')->group(function () {
    Route::GET('/', [ControladorJob::class, 'index'])->name('job_index');
    Route::POST('/novo', [ControladorJob::class, 'store'])->name('novo_job');
    Route::GET('/delete/{id}', [ControladorJob::class, 'destroy'])->name('job_delete');
    Route::GET('/edit/{id}', [ControladorJob::class, 'edit'])->name('job_edit');
    Route::PUT('/update/{id}', [ControladorJob::class, 'update'])->name('job_update');
});

//Rotas Tipo de Documento
Route::prefix('tp_documento')->group(function () {
    Route::GET('/', [ControladorTipoDocumento::class, 'index'])->name('tp_documento_index');
    Route::POST('/novo', [ControladorTipoDocumento::class, 'store'])->name('novo_tp_documento');
    Route::GET('/delete/{id}', [ControladorTipoDocumento::class, 'destroy'])->name('tp_documento_delete');
    Route::GET('/edit/{id}', [ControladorTipoDocumento::class, 'edit'])->name('tp_documento_edit');
    Route::PUT('/update/{id}', [ControladorTipoDocumento::class, 'update'])->name('tp_documento_update');
});

//Rotas Departamentos
Route::prefix('departamento')->group(function () {
    Route::GET('/', [ControladorDepartamento::class, 'index'])->name('departamento_index');
    Route::POST('/novo', [ControladorDepartamento::class, 'store'])->name('novo_departamento');
    Route::GET('/delete/{id}', [ControladorDepartamento::class, 'destroy'])->name('departamento_delete');
    Route::GET('/edit/{id}', [ControladorDepartamento::class, 'edit'])->name('departamento_edit');
    Route::PUT('/update/{id}', [ControladorDepartamento::class, 'update'])->name('departamento_update');
});

//Rotas Origens
Route::prefix('origem')->group(function () {
    Route::GET('', [ControladorOrigem::class, 'index'])->name('origem_index');
    Route::POST('/novo', [ControladorOrigem::class, 'store'])->name('novo_origem');
    Route::GET('/delete/{id}', [ControladorOrigem::class, 'destroy'])->name('origem_delete');
    Route::GET('/edit/{id}', [ControladorOrigem::class, 'edit'])->name('origem_edit');
    Route::PUT('/update/{id}', [ControladorOrigem::class, 'update'])->name('origem_update');
});

//Rotas Emitentes
Route::prefix('emitente')->group(function () {
    Route::GET('', [ControladorEmitente::class, 'index'])->name('emitente_index');
    Route::POST('/novo', [ControladorEmitente::class, 'store'])->name('novo_emitente');
    Route::GET('/delete/{id}', [ControladorEmitente::class, 'destroy'])->name('emitente_delete');
    Route::GET('/edit/{id}', [ControladorEmitente::class, 'edit'])->name('emitente_edit');
    Route::PUT('/update/{id}', [ControladorEmitente::class, 'update'])->name('emitente_update');
});

//Rotas Destinatarias
Route::prefix('destinataria')->group(function () {
    Route::GET('/', [ControladorDestinataria::class, 'index'])->name('destinataria_index');
    Route::POST('/novo', [ControladorDestinataria::class, 'store'])->name('novo_destinataria');
    Route::GET('/delete/{id}', [ControladorDestinataria::class, 'destroy'])->name('destinataria_delete');
    Route::GET('/edit/{id}', [ControladorDestinataria::class, 'edit'])->name('destinatarias_edit');
    Route::PUT('/update/{id}', [ControladorDestinataria::class, 'update'])->name('destinataria_update');
});

//Rotas Para Pesquisas
Route::prefix('pesquisas')->group(function () {
    Route::GET('/', [ControladorPesquisas::class, 'index'])->name('pesquisa_index');
    Route::POST('/', [ControladorPesquisas::class, 'show'])->name('pesquisa_novo');
    Route::GET('/getPdf/?',[ControladorPesquisas::class, 'getPdf'])->name('pesquisa_getPdf');
});

//Rotas Para Relatórios
Route::prefix('relatorios')->group(function () {
    Route::GET('/', [ControladorRelatorio::class, 'index'])->name('relatorio_index');
    Route::POST('/', [ControladorRelatorio::class, 'gerarRelatorio'])->name('gerar_relatorio');
    Route::POST('/Epdf', [ControladorRelatorio::class, 'exportPdf'])->name('export_Pdf');
});


//Rotas para Caixas
Route::prefix('caixas')->group(function () {
    Route::GET('/',[ControladorCaixasDepartamento::class, 'index'])->name('caixas');
    Route::POST('/novo', [ControladorCaixasDepartamento::class, 'store'])->name('nova_caixa');
    Route::GET('/abrir/{id}', [ControladorCaixasDepartamento::class, 'abrirCaixa'])->name('abrir_caixa');
    Route::GET('/fechar/{id}', [ControladorCaixasDepartamento::class, 'fecharCaixa'])->name('fechar_Caixa');
    Route::GET('/edit/{id}', [ControladorCaixasDepartamento::class, 'edit'])->name('caixa_edit');
    Route::PUT('/update/{id}', [ControladorCaixasDepartamento::class, 'update'])->name('caixa_update');
});