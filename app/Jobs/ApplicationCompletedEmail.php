<?php

namespace App\Jobs;

use App\Mail\UserCompletedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ApplicationCompletedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    protected $filename;

    protected $email;
    public $pdfContent;

    /**
     * @param $filePath
     * @param $email
     * @param $filename
     */
    public function __construct($email,$pdfContent)
    {
        $this->email = $email;
        $this->pdfContent = $pdfContent;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->email)
            ->send(new UserCompletedMail(base64_decode($this->pdfContent)));
    }
}
