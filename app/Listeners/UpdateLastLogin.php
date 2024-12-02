<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class UpdateLastLogin
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;  // Get the user who just logged in

        // Update the last_login field
        $user->last_login = now();  // `now()` is a Laravel helper for the current timestamp
        $user->save();
    }
}
