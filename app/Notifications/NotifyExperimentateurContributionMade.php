<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyExperimentateurContributionMade extends Notification
{
    use Queueable;
    public $cagnotte;
    public $contribution;
    /**
     * Create a new notification instance.
     */
    public function __construct($cagnotte,$contribution)
    {
        $this->cagnotte = $cagnotte;
        $this->contribution = $contribution;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hello')
                    ->line('Une contribution a été effectué sur une de tes cagnottes')
                    ->lineIf($this->cagnotte->titre,'Cagnotte contribué : {this->cagnotte->titre}')
                    ->lineIf($this->contribution->montant > 0, 'Montant de la contribution : {this->amount}')
                    ->action('Notification Action', url('#'))
                    ->line('Merci d\'avoir choisi LalaChante !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
