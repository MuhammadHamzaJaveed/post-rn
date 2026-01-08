<?php

namespace App\Observers;

use App\Models\PersonalDetail;
use App\Models\UserApplicationEdit;
use Carbon\Carbon;

class PersonalDetailObserver
{
    /**
     * Handle the PersonalDetail "created" event.
     *
     * @param  \App\Models\PersonalDetail  $personalDetail
     * @return void
     */
    public function created(PersonalDetail $personalDetail)
    {
        //
    }

    /**
     * Handle the PersonalDetail "updated" event.
     *
     * @param  \App\Models\PersonalDetail  $personalDetail
     * @return void
     */
    public function updated(PersonalDetail $personalDetail)
    {
        UserApplicationEdit::create([
            'user_id' => auth()->user()->id,
            'action' => 'personal_details_update',
            'time' => Carbon::now(),
        ]);
    }

    /**
     * Handle the PersonalDetail "deleted" event.
     *
     * @param  \App\Models\PersonalDetail  $personalDetail
     * @return void
     */
    public function deleted(PersonalDetail $personalDetail)
    {
        //
    }

    /**
     * Handle the PersonalDetail "restored" event.
     *
     * @param  \App\Models\PersonalDetail  $personalDetail
     * @return void
     */
    public function restored(PersonalDetail $personalDetail)
    {
        //
    }

    /**
     * Handle the PersonalDetail "force deleted" event.
     *
     * @param  \App\Models\PersonalDetail  $personalDetail
     * @return void
     */
    public function forceDeleted(PersonalDetail $personalDetail)
    {
        //
    }
}
