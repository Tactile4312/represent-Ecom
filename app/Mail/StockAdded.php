<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.stockAdded')
                    ->with('product', $this->product);
    }
}
