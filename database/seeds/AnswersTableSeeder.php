<?php

use Illuminate\Database\Seeder;
use App\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        

        $allAnswers = config('answer');

        foreach ($allAnswers as $question => $options) {
            foreach ($options as $key => $option) {
                $gameAnswer = new Answer();
                $gameAnswer->question_id = $question + 1;
                $gameAnswer->option = $option['option'];
                $gameAnswer->correct = $option['correct'];
                $gameAnswer->letter = $key;

                $gameAnswer->save();
            }
             
            
        }
    }
}
