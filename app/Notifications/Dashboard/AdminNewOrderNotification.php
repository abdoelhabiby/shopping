<?php

namespace App\Notifications\Dashboard;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AdminNewOrderNotification extends Notification
{
    use Queueable;
    public $order;
    public $data;


    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->handelDataReturnToNotifyAndDatabase();
    }


    protected function handelDataReturnToNotifyAndDatabase()
    {
        $user_name = $this->order->user ? $this->order->user->name : '';
        $image = null;

        if ($this->order->user && $this->order->user->image) {
            $user_image = $this->order->user->image;
            $image = File::exists(public_path($user_image)) ? asset($user_image) : pathNoImage();
        }


        $url = route('dashboard.orders.show', $this->order->id);

        return [

            'title' => 'new order',
            'message' => 'new order by customer ' .  $user_name . ' with amount ' . $this->order->amount,
            'url' => $url,
            'image' => $image
        ];


    }



}
