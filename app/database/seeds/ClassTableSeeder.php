<?php

class ClassTableSeeder extends Seeder {

    public function run()
    {
        DB::table('classes')->delete();

        $Classes = [
            "1Ac", "1Ae", "1AF", "1Ai", "1Am", "1Be", "1BF", "1Bi", "1Bm", "1CF", "1Ci", "1Cm", "1DF", "1Di", "1Ei", 
            "2Ac", "2Ae", "2AF", "2Ai", "2Am", "2Bc", "2Be", "2BF", "2Bi", "2Bm", "2CF", "2Ci", "2DF", 
            "3Ac", "3Ael", "3Aet", "3AF", "3Ai", "3Am", "3BF", "3Bi", "3Bm", "3CF", "3Ci", 
            "4Ac", "4Ael", "4Aet", "4AF", "4Ai", "4Am", "4BF", "4Bi", "4Bm", "4CF", 
            "5Ac", "5Ael", "5Aet", "5Af", "5Ai", "5Am", "5Bet", "5BF", "5Bi", "5CF"
        ];

        foreach($Classes as $name)
        {
            LimManager\Entities\Classes::create(['name' => $name]);
        }
    }

}