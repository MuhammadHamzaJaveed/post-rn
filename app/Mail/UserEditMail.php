<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEditMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $filePath;

    private string $displayName;
    private ?string $pdfContent;

    private int $isPaid;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(?string $pdfContent, $isPaid = 0)
    {
        /*$this->pdfContent = $pdfContent;*/
        $this->isPaid = $isPaid;
        $this->pdfContent = ($isPaid == 1) ? $pdfContent : null;

        \Log::info('UserEditMail Created', [
            'isPaid' => $this->isPaid,
            'pdfContent' => empty($this->pdfContent) ? 'No PDF' : 'PDF Exists'
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {

        \Log::info('Building Email', [
            'isPaid' => $this->isPaid,
            'pdfContent' => empty($this->pdfContent) ? 'No PDF' : 'PDF Exists'
        ]);
        $mail = $this->markdown('vendor.notifications.user_edited_email')
            ->with([
                'isPaid' => $this->isPaid
            ])
            ->subject('UHS Application Status');

        if ($this->isPaid == 1 && !empty($this->pdfContent))
        {
            $mail->attachData(base64_decode($this->pdfContent),
                "Application.pdf", [
                'mime' => 'application/pdf',
            ]);
        }else {
            \Log::info('Skipping PDF Attachment');
        }
        return $mail;
        }
}
