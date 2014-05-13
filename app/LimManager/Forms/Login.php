<?php namespace LimManager\Forms;

use Laracasts\Validation\FormValidator as Form;

class Login extends Form {

    protected $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

}