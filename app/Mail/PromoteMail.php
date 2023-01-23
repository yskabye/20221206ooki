<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $name, $subject, $words)
    {
        $this->data['from'] = $from;
        $this->data['name'] = $name;
        $this->data['subject'] = $subject ;
        $this->data['message'] = $words ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['from'], $this->data['name'])
                    ->subject($this->data['subject'])
                    ->markdown('emails.promote', ['message' => $this->data['message'] ]);
    }
}
