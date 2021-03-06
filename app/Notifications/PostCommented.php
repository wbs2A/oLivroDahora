<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Model\Comentarios;
use App\Model\Post;

class PostCommented extends Notification
{
    use Queueable;
    private $c;
    private $p;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comentarios $c, Post $p)
    {
        $this->c = $c;
        $this->p = $p;
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
                    ->subject('Novo Comentário')
                    ->greeting('Oi! Veja o novo comentario no seu post.')
                    ->line($this->c->texto)
                    ->action('Ver comentário', url('viewpost/'.$this->p->idpost))
                    ->salutation('Atenciosamente, oLivroDaHora');
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
