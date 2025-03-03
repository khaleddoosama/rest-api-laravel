<?php
namespace App\Listeners;

use App\Events\UserLogedIn;

class RevokeToken
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
    public function handle(UserLogedIn $event): void
    {
        $event->user->tokens()->delete();
    }
}