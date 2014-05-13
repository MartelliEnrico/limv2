@extends('layouts.main')

@section('content')

    @if($lims->count())
    @foreach($lims as $lim)

    <div class="lims">
        <a href="{{ route('lims.show', $lim->id) }}">{{ $lim->name }}</a>
        @if(Auth::check() && Auth::user()->group == 'admin')
        <div class="functions">
            <a href="{{ route('lims.edit', $lim->id) }}" class="edit">Modifica</a>
            <a href="{{ route('lims.destroy', $lim->id) }}" class="delete" data-method="DELETE">Elimina</a>
        </div>
        @endif
    </div>

    @endforeach
    @endif
    
    @if(Auth::check() && Auth::user()->group == 'admin')
    <p>{{ link_to_route('lims.create', 'Crea una nuova lim.', null, ['class' => 'button']) }}</p>
    @endif

@stop