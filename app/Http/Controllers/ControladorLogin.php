<?php

namespace App\Http\Controllers;

use App\Login;
use App\Departamentos;
use Illuminate\Http\Request;

class ControladorLogin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //Envia novo usuário para tela de login

        session()->put('autenticado', 0);
        return view('login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Consultando os Valores do envio $Request
        $log = new Login();
        $log->login = $request->input('login');
        $log->password = $request->input('password');

        //Consultando no Banco de Dados por usuário;
        $consulta = Login::all();



        

        foreach($consulta as $dados) {
                //Verifica se o login digitado está correto
                //dd($dados);  
                
                while ($dados['login'] == $log->login && $dados['ativo'] == 'Ativo') {
                    //Verificar Password se está correto.
                    if($dados['password'] == md5($log->password)) {
                        //Atribuir Permissão da  Sessão.
                            session()->put('permissao', $dados['permissao']);
                            session()->put('id_usuario', $dados['id_usuario']);
                            session()->put('departamento', $dados['departamento']);
                            session()->put('usuario',$log->login);
                            //dd(session()->get('usuario'));
                                                    //Autentica usuário
                            Login::where('id_usuario', $dados['id_usuario'])->update(['autenticado' => 1]);
                            session()->put('autenticado', 1);
                            //dd(session()->get('autenticado'));
                        //Envia usuário autenticado para pagina Dashboard.
                            if(session()->get('autenticado') == 1) {
                                return redirect(route('dashboard'));
                            }
                            else {
                                dd(session()->get('autenticado'));
                                session()->put('autenticado', '0');
                                return redirect(route('index'));
                            }
                                
                    }
                    else{
                        //Caso esteja errado a senha, informa o erro
                        //Senha errada, envia usuário com senha errada para pagina Dashboard
                            //return redirect(route('index'));
                            session()->put('autenticado', '0');
                            return redirect()->back()->withErrors(['erro' =>  'Senha Errada' ]);
                    }

                }
                //Tela branca
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Adiciona Usuário no banco de dados já com o MD5
        $log = new Login();
        $log->login = $request->input('login');
        $log->password = md5($request->input('password'));
        $log->permissao = $request->input('permissao');
        $log->departamento = $request->input('departamento');
        $log->ativo = $request->input('ativo');
        $log->save();

        //Mostra usuários Cadastrados na Tela de Cadastro
        $users = Login::all();
        $dep = Departamentos::orderBy('cad_departamento', 'ASC')->get();
        //dd($dep);
        
        return view('login/usuarios', compact('users', 'dep'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
 
        if(session()->get('autenticado') == 1) {
            //Mostra usuários na tela de Cadastro
            $users = Login::all();
            $dep = Departamentos::orderBy('cad_departamento', 'ASC')->get();
            return view('login/usuarios', compact('users', 'dep'));
        }
        else {
            return redirect(route('index'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit($id_usuario)
    {
        
        if(session()->get('autenticado') == 1) {
            $edit = Login::find($id_usuario);
            $dep = Departamentos::orderBy('cad_departamento', 'ASC')->get();
            return view('login/usuarios_update', compact('edit', 'dep'));
        }
        else {
            return redirect(route('index'));
        }
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_usuario)
    {
        if(session()->get('autenticado') == 1) {
            //Recupera Valores
            $log = new Login();
            $log->login = $request->input('login');
            $log->password = $request->input('password');
            $log->permissao = $request->input('permissao');
            $log->departamento = $request->input('departamento');
            $log->ativo = $request->input('ativo');

            //Altera Valores usuários Banco de Dados
            Login::where('id_usuario', $id_usuario)->update(['login' => $log->login]);
            Login::where('id_usuario', $id_usuario)->update(['password' => md5($log->password)]);
            Login::where('id_usuario', $id_usuario)->update(['permissao' => $log->permissao]);
            Login::where('id_usuario', $id_usuario)->update(['departamento' => $log->departamento]);
            Login::where('id_usuario', $id_usuario)->update(['ativo' => $log->ativo]);

            return redirect(route('configuracoes-usuarios'));
        }
        else {
            return redirect(route('index'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_usuario)
    {
        if(session()->get('autenticado') == 1) {
            $log = Login::find($id_usuario);
            $log->delete();
            return redirect(route('configuracoes-usuarios'));
        }
        else {
            return redirect(route('index'));
        }
        
    }

    public function leave()
    {
        if(session()->get('autenticado') == 1) {

            session()->put('autenticado', '0');
            Login::where('id_usuario', session()->get('id_usuario'))->update(['autenticado' => 0]);
            return redirect(route('index'));
        }
        else {
            return redirect(route('index'));
        }


    }

    public function paginaAlteraSenha(Request $request) {
        if(session()->get('autenticado') == 1) {
            $id_usuario_sessao = session()->get('id_usuario');
            //dd($id_usuario_sessao);
            $edit = Login::find($id_usuario_sessao);

            return view('forms_edit/usuario_update', compact('edit')); 
        }
        else {
            return redirect(route('index'));
        }

    }

    public function alterarSenha(Request $request) {
        if(session()->get('autenticado') == 1) {
            $usuario_sessao = session()->get('id_usuario');
            $log = Login::find($usuario_sessao);
            //dd($log);
            //$log->login = $request->input('login');
            $log->password = $request->input('password');
            //Altera Valores usuários Banco de Dados
            //Login::where('id_usuario', $usuario_sessao)->update(['login' => $log->login]);
            Login::where('id_usuario', $usuario_sessao)->update(['password' => md5($log->password)]);

            return redirect(route('dashboard'));
        }
        else {
            return redirect(route('index'));
        }

    }


}
