<?php

namespace App\Observers;

use App\Models\CollegePreference;
use App\Models\UserApplicationEdit;
use Carbon\Carbon;

class CollegePreferenceObserver
{
    /**
     * Handle the CollegePreference "created" event.
     *
     * @param  \App\Models\CollegePreference  $collegePreference
     * @return void
     */
    public function created(CollegePreference $collegePreference)
    {
        UserApplicationEdit::create([
            'user_id' => auth()->user()->id,
            'action' => 'college_preferences_create',
            'time' => Carbon::now(),
        ]);
    }

    /**
     * Handle the CollegePreference "updated" event.
     *
     * @param  \App\Models\CollegePreference  $collegePreference
     * @return void
     */
    public function updated(CollegePreference $collegePreference)
    {

    }

    /**
     * Handle the CollegePreference "deleted" event.
     *
     * @param  \App\Models\CollegePreference  $collegePreference
     * @return void
     */
    public function deleted(CollegePreference $collegePreference)
    {
        //
    }

    /**
     * Handle the CollegePreference "restored" event.
     *
     * @param  \App\Models\CollegePreference  $collegePreference
     * @return void
     */
    public function restored(CollegePreference $collegePreference)
    {
        //
    }

    /**
     * Handle the CollegePreference "force deleted" event.
     *
     * @param  \App\Models\CollegePreference  $collegePreference
     * @return void
     */
    public function forceDeleted(CollegePreference $collegePreference)
    {
        //
    }
}
