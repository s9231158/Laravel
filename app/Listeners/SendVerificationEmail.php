<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationEmail as SendVerificationEmailMail;
class SendVerificationEmail
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
    public function handle(Registered $event): void
    {
        dd($event);
        // Mail::to($event->user->email)->send(new SendVerificationEmailMail($event->user));
        try {
           
            Mail::to($event->user->email)->send(new SendVerificationEmailMail($event->user));
            \Log::info('郵件已成功發送至：' . $event->user->email);
        } catch (\Exception $e) {
            \Log::error('郵件發送失敗：' . $e->getMessage());
        }
    }
}
