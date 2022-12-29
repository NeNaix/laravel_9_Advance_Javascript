<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RegisterUserEvent  $event
     * @return void
     */
    public function handle($event)
    {
        \Mail::to($event->data['email'])->send(new \App\Mail\MailRegister($event->data));
    }
}
