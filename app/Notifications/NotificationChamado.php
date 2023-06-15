<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationChamado extends Notification
{
    use Queueable;
    private $chamado;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($chamado)
    {
        $this->chamado = $chamado;
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
            ->subject('Novo Chamado de Manutenção Aberto')
            ->greeting($this->chamado->Nome)
            ->line('Um novo chamado de manutenção foi aberto por '.Auth::user()->Nome.':')
            ->action('Ver Chamado de Manutenção', url('chamado/'.$this->chamado->ID))
            ->line('Obrigado por usar nosso Sistema Interno de Chamado e Compras!')
            ->salutation('Atenciosamente, Equipe Sicc');
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
