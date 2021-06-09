<?php

namespace App\Console\Commands;

use App\Model\Exams;
use Illuminate\Console\Command;

class ExamExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exams=Exams::userSelection()->active()->get();
        if($exams){
            foreach ($exams as $exam) {
                $date_active=$exam->updated_at;
                $date_diff=$date_active->diffInMinutes(date('Y-m-d H:i:s'));
    
                if ($date_diff >= $exam->duration) {
                    $exam->active=2;
                    $exam->save();
                }
            }
        }
    }
}
