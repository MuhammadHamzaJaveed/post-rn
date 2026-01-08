<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRequestPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $filePath;

    private string $displayName;

    private string $usersName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $filePath, string $displayName)
    {
        //
        $this->filePath = $filePath; // This should be the correct file path
        $this->displayName = $displayName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown( [
            'greeting' => trans('snp-portal.greetings_user', [
                'name' => $this->usersName,
            ]),
        ])
            ->subject(trans('Hello'))
            ->attach($this->filePath, [
                'as' => $this->displayName,
            ]);
    }
}