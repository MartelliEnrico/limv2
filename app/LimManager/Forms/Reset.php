<?php namespace LimManager\Forms;

use Laracasts\Validation\FormValidator as Form;

class Reset extends Form {

    protected $rules = [
        'class_id' => 'required|exists:persistents,class_id'
    ];

}