<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class notifyEarthquakeToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $quake;
    public $users;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quake, $user)
    {
        //
        $this->quake = $quake;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $quake = $this->quake;
        return $this->view('email.earthquake_notify', compact('quake', 'user'));
    }
}
