<?php

namespace App\Jobs;

use App\Mail\CancelMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class CancelNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $data;
    protected $username;
    /**
     * Create a new job instance.
     */
    public function __construct($data,$username)
    {
        //
        $this->data = $data;
        $this->username = $username;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $email = new CancelMail($this->username);
        Mail::to($this->data['email'])->send($email);
    }
}
