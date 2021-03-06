<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = config('question');
        
        foreach ($questions as $level => $question) {
            $gameQuestion = new Question();
            $gameQuestion->level = $level + 1;
            $gameQuestion->question = $question;

            $gameQuestion->save();
        }
           
        
    }
}
