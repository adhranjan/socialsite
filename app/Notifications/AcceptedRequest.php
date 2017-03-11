<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AcceptedRequest extends Notification implements ShouldQueue
{
    use Queueable;
    public  $user;
    public $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user=$user;
        $this->url=route('profile',$user->profile_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','broadcast','database',];
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
            ->line($this->user->name.' accepted your friend request')
            ->action('View Profile', $this->url)
            ->line('Thank you for using our social app');
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
            'name'=>$this->user->name,
            'message'=>"<a href=".$this->url.">".$this->user->name ." accepted your request</a>" ,
            'url'=>route('profile',$this->user->profile_id),
        ];
    }
}
