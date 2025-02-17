<?php

namespace App\Observers;

use App\Models\Lead;
use App\Notifications\LeadStatusChangedNotification;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     */
    public function created(Lead $lead): void
    {
        //    
    }

    /**
     * Handle the "updated" event.
     *
     * @param  \App\Models\Lead  $lead
     * @return void
     */
    public function updated(Lead $lead)
    {
        if ($lead->isDirty('status')) {
            $lead->user->notify(new LeadStatusChangedNotification($lead));
        }
    }

    /**
     * Handle the Lead "deleted" event.
     */
    public function deleted(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "restored" event.
     */
    public function restored(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "force deleted" event.
     */
    public function forceDeleted(Lead $lead): void
    {
        //
    }
}
