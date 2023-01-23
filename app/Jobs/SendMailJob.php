<?php

namespace App\Jobs;

use App\Mail\PromoteMail; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $to;
    protected $from;
    protected $name;
    protected $subject;
    protected $message;

    public function __construct($to, $from, $name, $subject, $message)
    {
        $this->to = $to;
        $this->from = $from;
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(new PromoteMail($this->from, $this->name, $this->subject, $this->message));
    }
}
