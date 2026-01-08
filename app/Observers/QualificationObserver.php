<?php

namespace App\Observers;

use App\Models\Qualification;
use App\Models\UserApplicationEdit;
use Carbon\Carbon;

class QualificationObserver
{
    /**
     * Handle the Qualification "created" event.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return void
     */
    public function created(Qualification $qualification)
    {
        //
    }

    /**
     * Handle the Qualification "updated" event.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return void
     */
    public function updated(Qualification $qualification)
    {
        UserApplicationEdit::create([
            'user_id' => auth()->user()->id,
            'action' => 'qualifications_update',
            'time' => Carbon::now(),
        ]);
    }

    /**
     * Handle the Qualification "deleted" event.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return void
     */
    public function deleted(Qualification $qualification)
    {
        //
    }

    /**
     * Handle the Qualification "restored" event.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return void
     */
    public function restored(Qualification $qualification)
    {
        //
    }

    /**
     * Handle the Qualification "force deleted" event.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return void
     */
    public function forceDeleted(Qualification $qualification)
    {
        //
    }
}
