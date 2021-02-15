<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UsersEventListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        \Mail::send('emails.auth.confirm', ['confirmUrl' => config('app.url') . '/confirm/?code=' . $user->confirm_code],
            function ($message) use ($user) {
            $message->to($user->email, $user->name);

            $message->subject(
                sprintf('[%s] 회원가입을 확인해 주세요.', config('app.name'))
            );
        });
    }
}
