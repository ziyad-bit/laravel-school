<?php

namespace App\Console\Commands;

use App\Model\Exams;
use Illuminate\Console\Command;

class ExamActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'activate every exam in time';

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
        $exams=Exams::selection()->where('active',0)->get();
        if($exams){
            foreach ($exams as $exam) {
                if(date('Y-m-d H:i:s') >= $exam->date){
                    $exam->update([
                        'active'=>1
                    ]);
                };     
            }
        }
    }
}
