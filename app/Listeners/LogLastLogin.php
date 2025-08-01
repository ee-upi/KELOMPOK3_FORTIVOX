<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogLastLogin
{
    public function handle(Login $event)
    {
        $event->user->update([
            'last_login_at' => now()->setTimezone('Asia/Jakarta'),
        ]);
    }
}
