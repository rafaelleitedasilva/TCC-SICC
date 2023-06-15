<?php

namespace App\Listeners;

use App\Events\MaintenanceTicketOpened;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMaintenanceTicketOpenedNotification
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
     * @param  \App\Events\MaintenanceTicketOpened  $event
     * @return void
     */
    public function handle(MaintenanceTicketOpened $event)
    {
        //
    }
}
