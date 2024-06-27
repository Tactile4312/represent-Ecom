<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Message;

class MessageReply extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message, $reply)
    {
        $this->message = $message;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reply to your message')
                    ->view('emails.reply')
                    ->with([
                        'name' => $this->message->name,
                        'reply' => $this->reply,
                    ]);
    }
}
