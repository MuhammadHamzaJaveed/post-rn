<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $filePath;

    private string $displayName;
    private string $pdfContent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $pdfContent)
    {
        $this->pdfContent = $pdfContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('vendor.notifications.user_completed_email')
            ->subject('UHS Application Status')
            ->attachData($this->pdfContent, "Application.pdf", [
                'mime' => 'application/pdf',
            ]);           
    }
}
