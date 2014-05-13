<?php namespace LimManager\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use LimManager\Forms\Login as LoginForm;

class AuthController extends Controller {

    protected $loginForm;

    public function __construct(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;

        $this->beforeFilter('csrf', ['on' => 'post']);
        $this->beforeFilter('guest', ['except' => 'logout']);
        $this->beforeFilter('auth', ['only' => 'logout']);
    }

    public function login()
    {
        return View::make('auth.login');
    }

    public function postLogin()
    {
        $this->loginForm->validate($input = Input::only('username', 'password'));

        if(Auth::attempt($input))
        {
            return Redirect::intended('/');
        }

        return Redirect::back()->withInput()->withFlashMessage('Dati di autenticazione errati.');
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }

}