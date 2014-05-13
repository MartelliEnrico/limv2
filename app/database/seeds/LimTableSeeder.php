<?php

class LimTableSeeder extends Seeder {

    public function run()
    {
        DB::table('lims')->delete();

        $Lims = [
            "101", "102", "103", "105", "106", "107", "108", "109", "110", "111", "112", "113", "115", "116"
        ];

        foreach($Lims as $name)
        {
            LimManager\Entities\Lim::create(['name' => $name]);
        }
    }

}