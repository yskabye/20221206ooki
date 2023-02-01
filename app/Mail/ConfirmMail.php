<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

define('SUBJECT', 'ご予約確認');

class ConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data = [];

    public function __construct($from, $fromname, $toname, $shop_name, $time, $men_num)
    {
        $this->data['from'] = $from;
        $this->data['fromname'] = $fromname;
        $this->data['toname'] = $toname;
        $this->data['shop_name'] = $shop_name ;
        $this->data['time'] = $time;
        $this->data['men_num'] = $men_num;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['from'], 
                    $this->data['shop_name'] . '店長 ' .$this->data['fromname'] )
                    ->subject(SUBJECT)
                    ->markdown('emails.confirm',
                                ['name' => $this->data['toname'],
                                 'time' => $this->data['time'],
                                 'shop_name' => $this->data['shop_name'],
                                 'staff_name' => $this->data['fromname'],
                                 'men_num' => $this->data['men_num'],
                                ]);
    }
}
