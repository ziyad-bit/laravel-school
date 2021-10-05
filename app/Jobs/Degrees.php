<?php

namespace App\Jobs;

use App\Model\Degrees as ModelDegrees;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Degrees implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $data;
    protected  $exam;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$exam)
    {
        $this->data=$data;
        $this->exam=$exam;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ModelDegrees $degrees)
    {
        $users   = $this->data;
        $exam    = $this->exam;

        foreach ($users as  $user) {
            $degrees::create([
                'exam_id'    => $exam->id,
                'user_id'    => $user->id,
                'subject_id' => $exam->subject_id,
            ]);
        }
    }
}
