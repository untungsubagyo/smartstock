<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use PhpParser\Node\Expr\Cast\Object_;

class UpdateLastLoginAt
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
    public function handle(Object $event): void
    {
        $user = $event->user;

        if ($user && $user->fillable && in_array('last_login_at', $user->getFillable())) {
            $user->update(['last_login_at' => now()]);
        } else {
            // fallback jika tidak ada di fillable
            $user->last_login_at = now();
            $user->save();
        }
    }
}
