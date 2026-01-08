<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPDFMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $filePath;

    private string $displayName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('vendor.notifications.user_pdf_email')
            ->subject('UHS Application Status');
    }
}
