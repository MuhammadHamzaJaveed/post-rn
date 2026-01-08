<?php

namespace App\Jobs;

use App\Mail\UserPDFMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    protected $filename;

    protected $email;

    /**
     * @param $filePath
     * @param $email
     * @param $filename
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->email)
            ->send(new UserPDFMail());
    }
}
