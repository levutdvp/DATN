<?php

namespace App\Jobs;

use App\Mail\RoomPostNotificationMail;
use App\Mail\SuccessMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class RoomPostNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $content;
    /**
     * Create a new job instance.
     */
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data,$content)
    {
        //
        $this->data = $data;
        $this->content = $content;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $email = new RoomPostNotificationMail($this->content);
        Mail::to($this->data['email'])->send($email);
    }
}
