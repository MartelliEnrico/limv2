<?php namespace LimManager\Forms;

use Laracasts\Validation\FormValidator as Form;

class Reserve extends Form {

    protected $rules = [
        'hours' => 'required',
        'class_id' => 'required|exists:classes,id'
    ];

}