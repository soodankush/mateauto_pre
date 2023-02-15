<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\VerifyEmail;
use App\Models\PreLaunchEmail;

class SendVerificationEmailToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->user = PreLaunchEmail::where('id',$userId)->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('Inside ' .  __METHOD__);
        try{
            Mail::to($this->user['email'])->send(new VerifyEmail($this->user));
            return true;
        } catch(\Exception $e) {
            \Log::info($e);
            return false;
        }
        
    }
}
