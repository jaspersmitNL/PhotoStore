<?php

namespace App\Mail;

use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmEmail extends Mailable {
    use Queueable, SerializesModels;

    public $order;
    public $photos = array();


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order) {
        $this->order = $order;

        foreach (json_decode($order->photos) as $id) {
            array_push($this->photos, Photo::findOrFail($id));
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this
            ->subject('Bedankt voor je bestelling #' . $this->order->id)
            ->markdown('emails.order.confirm');
    }
}
