<?php

namespace App\Notifications;

use App\Models\Contato;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NovoContato extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contato;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct(Contato $contato)
    {
        //ddd($contato);
        $this->contato = $contato;
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
                    ->line('Você recebeu um novo contato pelo site.')
                    /*->action('Notification Action', url('/'))*/
                    /*->line('Thank you for using our application!');*/
                    ->line('De: '. $this->contato->nome)
                    ->line('E-mail: '. $this->contato->email)
                    ->line('Mensagem: ' . $this->contato->mensagem);
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
