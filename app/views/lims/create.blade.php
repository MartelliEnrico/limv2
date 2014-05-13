@extends('layouts.main')

@section('title', 'Crea una nuova Lim')

@section('content')

    {{ Form::open(['route' => 'lims.store']) }}

        <div class="form-group">
            <h1>Crea una nuova Lim</h1>
        </div>

        {{ form_text('name', 'Nome:', $errors) }}

        {{ form_submit('Crea nuova Lim') }}

    {{ Form::close() }}

@stop