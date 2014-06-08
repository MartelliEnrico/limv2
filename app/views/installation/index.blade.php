@extends('layouts.plain')

@section('body')

<div class="container" style="margin-bottom: 40px">

    {{ Form::open(['method' => 'GET']) }}
        
        {{ Form::text('key', Session::get('key', null)) }}

        {{ Form::submit('Configura Installazione', ['class' => 'button']) }}

    {{ Form::close() }}

</div>

@stop