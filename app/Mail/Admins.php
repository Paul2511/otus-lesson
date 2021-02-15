<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Admins extends Mailable
{
    use Queueable, SerializesModels;

    private $login, $email, $password;
    
    public function __construct($data)
    {
        $this->login = $data['login'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admins')->with([
            'login'=>$this->login,
            'email'=>$this->email,
            'password'=>$this->password,
            ]);
    }
}
