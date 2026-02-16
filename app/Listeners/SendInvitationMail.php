<?php

namespace App\Listeners;

use App\Events\UserInvited;
use App\Mail\InvitationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendInvitationMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserInvited $event): void
    {
        $user = $event->user;
        $password = $event->plainPassword;

        Mail::to($user->email)->send(new InvitationMail($user, $password));
    }
}
