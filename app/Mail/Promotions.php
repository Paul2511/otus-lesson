<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Promotions extends Mailable
{
    use Queueable, SerializesModels;

    private $title, $text, $validate_to;
    
    public function __construct($data)
    {
        $this->title = $data['title'];
        $this->text = $data['text'];
        $this->validate_to = $data['validate_to'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.promotions')->with([
            'title'=>$this->title,
            'text'=>$this->text,
            'validate_to'=>$this->validate_to,
            ]);
    }
}
