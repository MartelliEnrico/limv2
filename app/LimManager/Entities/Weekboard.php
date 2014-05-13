<?php namespace LimManager\Entities;

class Weekboard extends \Eloquent {

    protected $fillable = ['lim_id'];

    public function lim()
    {
        return $this->belongsTo('LimManager\Entities\Lim');
    }

    public function hours()
    {
        return $this->morphMany('LimManager\Entities\Hour', 'reservable');
    }

}