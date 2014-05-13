<?php namespace LimManager\Forms;

use Laracasts\Validation\FormValidator as Form;

class DayHour extends Form {

    protected $rules = [
        'day' => 'required|integer|min:1|max:6',
        'hour' => 'required|integer|min:1|max:6'
    ];

}