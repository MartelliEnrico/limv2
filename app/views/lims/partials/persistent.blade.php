@if(isset($table[$x][$y]))
<?php $hour = $table[$x][$y]; ?>
Classe {{ $hour['classes']['name'] }}
@else
{{ Form::checkbox("hour-$x-$y", "[$x,$y]", false, ['id' => "hour-$x-$y"]).Form::label("hour-$x-$y", 'Seleziona') }}
@endif