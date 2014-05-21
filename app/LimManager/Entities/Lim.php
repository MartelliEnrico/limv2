<?php namespace LimManager\Entities;

use Carbon\Carbon;

class Lim extends \Eloquent {

    protected $fillable = ['name'];

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
            $weekboard = Weekboard::create(['lim_id' => $this->id]);
        }

        return $weekboard;
    }

}