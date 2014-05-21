<?php

View::composer(['lims.show', 'lims.edit'], function($view)
{
    $view->with('classes', Classes::all()->lists('name', 'id'));

    $view->with('days', [
        1 => 'Lunedì',
        2 => 'Martedì',
        3 => 'Mercoledì',
        4 => 'Giovedì',
        5 => 'Venerdì',
        6 => 'Sabato'
    ]);

    $view->with('hours', [
        1 => '1° ora',
        2 => '2° ora',
        3 => '3° ora',
        4 => '4° ora',
        5 => '5° ora',
        6 => '6° ora'
    ]);
});