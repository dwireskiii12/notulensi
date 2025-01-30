<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\NotulensiAccountMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendNotulensiAccountEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $password;
    protected $meeting;
    /**
     * Create a new job instance.
     */
    public function __construct($name, $email, $password, $meeting)
    {
        //
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->meeting = $meeting;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)
        ->send(new NotulensiAccountMail(
            $this->name,
            $this->email,
            $this->password,
            $this->meeting
        ));
        //
    }
}
