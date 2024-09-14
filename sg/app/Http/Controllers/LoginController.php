<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request) {

        $erro = '';

        if($erro = $request->get('erro') == 1) {
            $erro = 'Usuário ou senha inválidos';
        }

        if($erro = $request->get('erro') == 2) {
            $erro = 'Faça login para acessar esta página';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request) {

        // Regras de validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        // Mensagens de feedback
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) deve ser um endereço de e-mail válido.',
            'senha.required' => 'O campo senha é obrigatório.'
        ];

        // se não passar na validação, redireciona para a página anterior
        $request->validate($regras, $feedback);

        // se passar na validação, exibe os dados
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //iniciar o model User
        $user = new User();

        //verificar se o usuário existe
        $usuario = $user->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();

        if(isset($usuario->name)) {

            session_start();
            $_SESSION['name'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');

        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair() {
        session_destroy();
        return redirect()->route('site.index');
    }
}
