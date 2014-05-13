<?php namespace LimManager\Forms;

use Laracasts\Validation\FormValidator as Form;

class Lim extends Form {

    protected $rules = [
        'name' => 'required|unique:lims,name'
    ];

}