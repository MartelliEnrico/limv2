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

    $hours = [];

    for($i = 1, $n = Config::get('lim.max_hours_number', 6); $i <= $n; $i++)
    {
        $hours[$i] = "$i<sup>a</sup> ora";
    }

    $view->with('hours', $hours);
});

View::composer('lims.show', function($view)
{
    $weeks = [];

    for($i = 0; $i < 4; $i++)
    {
        $start = strtotime(date('o-\\WW')." +$i week");
        $end = strtotime(date('o-\\WW')." +$i week +6 day");
        $weeks[date('Y-m-d', $start)] = date('d/m/Y', $start)." - ".date('d/m/Y', $end); 
    }

    $view->with('weeks', $weeks);
});
