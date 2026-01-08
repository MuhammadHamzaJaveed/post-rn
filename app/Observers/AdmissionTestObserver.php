<?php

namespace App\Observers;

use App\Models\AdmissionTest;
use App\Models\UserApplicationEdit;
use Carbon\Carbon;

class AdmissionTestObserver
{
    /**
     * Handle the AdmissionTest "created" event.
     *
     * @param  \App\Models\AdmissionTest  $admissionTest
     * @return void
     */
    public function created(AdmissionTest $admissionTest)
    {
        //
    }

    /**
     * Handle the AdmissionTest "updated" event.
     *
     * @param  \App\Models\AdmissionTest  $admissionTest
     * @return void
     */
    public function updated(AdmissionTest $admissionTest)
    {
        UserApplicationEdit::create([
            'user_id' => auth()->user()->id,
            'action' => 'admission_tests_update',
            'time' => Carbon::now(),
        ]);
    }

    /**
     * Handle the AdmissionTest "deleted" event.
     *
     * @param  \App\Models\AdmissionTest  $admissionTest
     * @return void
     */
    public function deleted(AdmissionTest $admissionTest)
    {
        //
    }

    /**
     * Handle the AdmissionTest "restored" event.
     *
     * @param  \App\Models\AdmissionTest  $admissionTest
     * @return void
     */
    public function restored(AdmissionTest $admissionTest)
    {
        //
    }

    /**
     * Handle the AdmissionTest "force deleted" event.
     *
     * @param  \App\Models\AdmissionTest  $admissionTest
     * @return void
     */
    public function forceDeleted(AdmissionTest $admissionTest)
    {
        //
    }
}
