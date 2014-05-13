@extends('layouts.main')

@section('title', 'Login')

@section('content')

    {{ Form::open() }}
        <div class="form-group">
            <h1>Login</h1>
        </div>

        {{ form_text('username', 'Nome utente:', $errors) }}

        {{ form_password('password', 'Password:', $errors) }}

        {{ form_submit('Login') }}

    {{ Form::close() }}

@stop