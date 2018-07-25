<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($itemArray)
    {
        $this->item = $itemArray;
        $this->replyTo($itemArray['email'],$itemArray['name']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact')->subject('New Inquery Submitted!');
    }
}