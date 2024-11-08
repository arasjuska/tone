<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GiftCardGenerated extends Notification
{
    use Queueable;

    public function __construct(protected $giftCard, protected $pdfPath)
    {

    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Your Gift Card Has Been Generated'))
            ->line(__('Please find your gift card attached.'))
            ->attach($this->pdfPath, [
                'as' => 'gift-card.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
