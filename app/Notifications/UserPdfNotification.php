<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserPdfNotification extends Notification
{
    use Queueable;
    protected $pdfContent;
    protected $user;

    protected $filename;

    public $pathToPDF;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $filename)
    {
        $this->user = $user;
        $this->filename = $filename;

        $this->pathToPDF = url('storage/' . $this->filename);

    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Download Application PDF', $this->pathToPDF) // Link directly to the PDF URL
            ->with(['pdfContent' => $this->pdfContent]); // Pass variables to the Blade template
    }





    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
