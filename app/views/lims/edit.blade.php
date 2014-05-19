@extends('layouts.main')

@section('title', 'Modifica Lim '.$lim->name)

@section('content')

    <h1>Modifica la Lim {{ $lim->name }}</h1>

    {{ Form::model($lim, ['route' => ['lims.update', $lim->id], 'method' => 'PATCH']) }}

        <h3>Modifica nome</h3>

        {{ form_text('name', 'Nome:', $errors) }}

        {{ form_submit('Modifica Lim') }}

    {{ Form::close() }}

    <h3>Modifica classi</h3>
    
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
            @for($y = 1; $y <= 6; $y++)
            <tr>
                <th class="clmn-hour">{{ $hours[$y] }}</th>
                @for($x = 1; $x <= 6; $x++)
                <td>@include('lims.partials.persistent')</td>
                @endfor
            </tr>
            @endfor
        </tbody>

    </table>

    {{ Form::open(['route' => ['lims.persistent', $lim->id], 'id' => 'reservable']) }}

        {{ form_hidden('hours', $errors) }}

        {{ form_select('class_id', 'Classe:', $classes, $errors) }}

        <div class="form-group">
            {{ Form::submit('Aggiungi classe').Form::submit('Rimuovi classe', ['data-action' => route('lims.persistent.reset', $lim->id)]) }}
        </div>

    {{ Form::close() }}

@stop
