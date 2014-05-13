@if(isset($table[$x][$y]))
<?php $hour = $table[$x][$y]; ?>
Classe {{ $hour['classes']['name'] }}
@if($hour['reservable_type'] == 'LimManager\Entities\Weekboard')
<br>Prof. {{ $hour['teacher']['full_name'] }}
@if(Auth::check() && (Auth::user()->id == $hour['teacher_id'] || Auth::user()->group == 'admin'))
<br>{{ Form::open(['route' => ['lims.reserve.remove', $lim->id]]).
        Form::hidden('hour_id', $hour['id']).
        Form::submit('&times;').
    Form::close() }}
@endif
@endif
@else
@if(Auth::check() && Auth::user()->group == 'teacher')
{{ Form::checkbox("hour-$x-$y", "[$x,$y]", false, ['id' => "hour-$x-$y"]).Form::label("hour-$x-$y", 'Seleziona') }}
@else
...
@endif
@endif