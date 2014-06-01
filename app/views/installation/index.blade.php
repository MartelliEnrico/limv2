@extends('layouts.plain')

@section('body')

<div id="installation">
    <p>Hai configurato adeguatamente il file <code>app/config/lim.php</code>? Allora procedi all'installazione.</p>
    <a href="{{ url('start') }}" class="button">Installa LimManager</a>
</div>

@stop