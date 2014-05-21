@if(isset($table[$x][$y]))
    <?php $hour = $table[$x][$y]; ?>
    <span class="line-class">{{ $hour['classes']['name'] }}</span>
@else
    {{ Form::checkbox("hour-$x-$y", "[$x,$y]", false, ['id' => "hour-$x-$y"]).Form::label("hour-$x-$y", 'Seleziona') }}
@endif
