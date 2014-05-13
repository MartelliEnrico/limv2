<?php namespace LimManager\Entities;

class Persistent extends \Eloquent {

    protected $fillable = ['lim_id', 'class_id'];

    public function lim()
    {
        return $this->belongsTo('LimManager\Entities\Lim');
    }

    public function classes()
    {
        return $this->belongsTo('LimManager\Entities\Classes', 'class_id');
    }

    public function hours()
    {
        return $this->morphMany('LimManager\Entities\Hour', 'reservable');
    }

}