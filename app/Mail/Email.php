<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    protected $c;
    protected $u;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($c,$u)
    {
        $this->c = $c;
        $this->u = $u;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->view('layouts.app')
        ->with(['compra' => $this->c, 'user' => $this->u]);
    }
}
