<?php

namespace App\Listeners;

use App\Events\UserLogedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        // سحب جميع الرموز المميزة للمستخدم عند تسجيل الدخول
        $event->user->tokens()->delete();
    }
}
