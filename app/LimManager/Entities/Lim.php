<?php namespace LimManager\Entities;

use Carbon\Carbon;

class Lim extends \Eloquent {

    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function weekboards()
    {
        return $this->hasMany('LimManager\Entities\Weekboard');
    }

    public function persistents()
    {
        return $this->hasMany('LimManager\Entities\Persistent');
    }

    public function currentWeekboard($date = null)
    {
        $week = Carbon::createFromTimeStamp(strtotime($date ?: date('o-\\WW')));
        $start = $week->startOfDay();
        $end = Carbon::instance($week)->addDays(6)->endOfDay();

        $weekboard = $this->weekboards()->whereBetween('created_at', [$start, $end])->first();

        if(is_null($weekboard))
        {
            $weekboard = new Weekboard;
            $weekboard->lim_id = $this->id;
            $weekboard->created_at = $start;
            $weekboard->updated_at = $start;
            $weekboard->save();
        }

        return $weekboard;
    }

}