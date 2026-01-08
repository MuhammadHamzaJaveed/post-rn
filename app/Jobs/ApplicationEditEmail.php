<?php

namespace App\Jobs;

use App\Mail\UserEditMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ApplicationEditEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    protected $filename;

    protected $email;
    public $pdfContent;
    protected $isPaid;

    /**
     * @param $filePath
     * @param $email
     * @param $filename
     */
    public function __construct($email,$pdfContent = null, $isPaid = 0)
    {
        $this->email = $email;
        /*$this->pdfContent = $pdfContent;*/
        $this->isPaid = $isPaid;
        $this->pdfContent = ($isPaid == 1) ? $pdfContent : null;

        \Log::info('ApplicationEditEmail Job Created', [
            'email' => $this->email,
            'isPaid' => $this->isPaid,
            'pdfContent' => empty($this->pdfContent) ? 'No PDF' : 'PDF Exists'
        ]);
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        \Log::info('Handling Email Sending', [
            'email' => $this->email,
            'isPaid' => $this->isPaid,
            'pdfContent' => empty($this->pdfContent) ? 'No PDF' : 'PDF Exists'
        ]);
        Mail::to($this->email)
            ->send(new UserEditMail($this->pdfContent, $this->isPaid));
    }
}
