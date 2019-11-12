<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        //
        $this->password = $password;

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
          ->subject('User Registration') // it will use this class name if you don't specify
          ->greeting('Dear User,') // example: Dear Sir, Hello Madam, etc ...
            ->level('info')// It is kind of email. Available options: info, success, error. Default: info
            ->line('Your user on ERP system has been created.Please use the following credentials for login:')
            ->line('Email:'.$notifiable->email)
            ->line('Password:'.$this->password)
            ->action('Login', url('/client/login'))
            ->line('Thank you for using our application!');
//          ->salutation('');  // example: best regards, thanks, etc ...
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
