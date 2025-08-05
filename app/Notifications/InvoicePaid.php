<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;
    public $invoiceNumber;
    /**
     * Create a new notification instance.
     */
    public function __construct($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }



    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        return [
            "message" => "Invoice #{$this->invoiceNumber} has been paid.",
            "invoice_number" => $this->invoiceNumber,
            "user_id" => $notifiable->id,
            "created_at" => now(),
            'notified_user_id' => $notifiable->id,
            'notified_user_email' => $notifiable->email,
        ];
        
    
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
