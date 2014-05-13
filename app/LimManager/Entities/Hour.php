<?php namespace LimManager\Entities;

class Hour extends \Eloquent {

    protected $fillable = ['day', 'hour'];

    public function reservable()
    {
        return $this->morphTo();
    }

    public function classes()
    {
        return $this->hasOne('LimManager\Entities\Classes', 'id', 'class_id');
    }

    public function teacher()
    {
        return $this->hasOne('LimManager\Entities\User', 'id', 'teacher_id');
    }

}