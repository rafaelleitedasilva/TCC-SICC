<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationItem extends Notification
{
    use Queueable;
    private $Itens;
    private $chamado;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($Itens, $chamado)
    {
        $this->Itens = $Itens;
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
        $string = '';

        foreach($this->Itens as $item){
            $string .= "$item,";
        }

        $string = rtrim($string, ",");

        $num = count($this->Itens);

        if(count($this->Itens)>1){
            $line = "Realizar pedido de compra para os seguintes itens: $string.";
            $greetings = "O chamado ".$this->chamado->Nome." utilizou $num itens";
        }else{
            $line = "Realizar pedido de compra para o seguinte item: $string.";
            $greetings = 'O chamado '.$this->chamado->Nome.' utilizou 1 item';
        }

        return (new MailMessage)
            ->subject('Item utilizado em chamado!')
            ->greeting($greetings)
            ->line($line)
            ->line('Obrigado por usar nosso Sistema Interno de Itens e Compras!')
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
