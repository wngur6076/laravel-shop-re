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

    public function subscribe(\Illuminate\Events\Dispatcher $events)
    {
        $events->listen(
            \App\Events\PasswordRemindCreated::class,
            __CLASS__ . '@onPasswordRemindCreated'
        );
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

        \Mail::send('emails.auth.confirm', ['confirmUrl' => config('app.url') . '/auth/confirm/?code=' . $user->confirm_code],
            function ($message) use ($user) {
            $message->to($user->email, $user->name);

            $message->subject(
                sprintf('[%s] 회원가입을 확인해주세요.', config('app.name'))
            );
        });
    }

    public function onPasswordRemindCreated(\App\Events\PasswordRemindCreated $event)
    {
        $user = $event->user;

        \Mail::send('emails.passwords.reset', ['resetUrl' => config('app.url') . '/password/reset/?code=' . $event->code,
        'name' => $user->name], function ($message) use ($user) {
            $message->to($user->email, $user->name);
            $message->subject(
                sprintf('[%s] 비밀번호를 초기화하세요.', config('app.name'))
            );
        });
    }
}
