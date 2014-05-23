<?php

View::composer(['lims.show', 'lims.edit'], function($view)
{
    $view->with('classes', LimManager\Entities\Classes::all()->lists('name', 'id'));

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

View::composer('lims.show', function($view)
{
    $weeks = [];

    for($i = 0; $i < 4; $i++)
    {
        $start = date('Y-m-d', strtotime(date('o-\\WW')." +$i week"));
        $end = date('d/m/Y', strtotime(date('o-\\WW')." +$i week +6 day"));
        $weeks[$start] = $start." - ".$end; 
    }

    $view->with('weeks', $weeks);
});
