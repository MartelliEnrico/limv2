<?php namespace LimManager\Forms;

use Laracasts\Validation\FormValidator as Form;

class Remove extends Form {

    protected $rules = [
        'hour_id' => 'required|exists:hours,id'
    ];

}