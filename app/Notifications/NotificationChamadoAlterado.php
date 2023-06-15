<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationChamadoAlterado extends Notification
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
        if($this->chamado->Processo == '1'){
            $line = 'Seu chamado está sendo atendido por '.$this->chamado->Manutentor.', clique no link abaixo para acompanhar as atualizações:';
            $subject = 'Chamado sendo atendido!';
        }else if($this->chamado->Processo == '2'){
            $line = 'Seu chamado foi concluído por '.$this->chamado->Manutentor.', clique no link abaixo para ver as atualizações:';
            $subject = 'Chamado concluído!';
        }else{
            $line = 'Seu chamado foi cancelado por '.$this->chamado->Manutentor.', clique no link abaixo para ver o motivo:';
            $subject = 'Chamado cancelado!';
        }

        return (new MailMessage)
        ->subject($subject)
        ->greeting($this->chamado->Nome)
        ->line($line)
        ->action('Ver Chamado', url('chamado/'.$this->chamado->ID))
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
