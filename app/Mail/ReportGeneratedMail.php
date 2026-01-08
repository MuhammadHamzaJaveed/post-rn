<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportGeneratedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $template;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filePath,$template)
    {
        $this->filePath = $filePath;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Report for Verification Team';
        if(isset($this->template) && $this->template == 'pref'){
            $subject = 'Report with Preference for Verification Team';
        }
        if(isset($this->template) && $this->template == 'pref_overseas'){
            $subject = 'Report with Preference Overseas for Verification Team';
        }
        return $this->subject($subject)
                    ->view('emails.report-generated')
                    ->attach(storage_path('app/public/' . $this->filePath), [
                        /*'as' => 'mbbs-private-report.xlsx',*/
                        'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
    }
}
