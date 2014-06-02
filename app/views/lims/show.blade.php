@extends('layouts.main')

@section('title', 'Lim '.$lim->name)

@section('content')

    <h1 class="float">Lim {{ $lim->name }}</h1>

    <div class="week-chooser">{{ form_select('weeks', 'Seleziona settimana:', $weeks, $errors, Input::get('week')) }}</div>

    <table class="reservable-table">

        <thead>
            <tr>
                <th class="clmn-hour"></th>
                <th>{{ $days[1] }}</th>
                <th>{{ $days[2] }}</th>
                <th>{{ $days[3] }}</th>
                <th>{{ $days[4] }}</th>
                <th>{{ $days[5] }}</th>
                <th>{{ $days[6] }}</th>
            </tr>
        </thead>

        <tbody>
            @for($y = 1; $y <= Config::get('lim.max_hours_number'); $y++)
            <tr>
                <th class="clmn-hour">{{ $hours[$y] }}</th>
                @for($x = 1; $x <= 6; $x++)
                <td>@include('lims.partials.cell')</td>
                @endfor
            </tr>
            @endfor
        </tbody>

    </table>

    @if(Auth::check() && Auth::user()->group == 'teacher')
    {{ Form::open(['url' => route('lims.reserve', $lim->id).(Input::has('week') ? '?week='.Input::get('week') : ''), 'id' => 'reservable']) }}

        {{ form_hidden('hours', $errors) }}

        {{ form_select('class_id', 'Classe:', $classes, $errors) }}

        {{ form_submit('Prenota Lim') }}

    {{ Form::close() }}
    @endif

@stop
