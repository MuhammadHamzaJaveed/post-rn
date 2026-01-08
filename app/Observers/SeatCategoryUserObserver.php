<?php

namespace App\Observers;

use App\Models\SeatCategoryUser;
use App\Models\UserApplicationEdit;
use Carbon\Carbon;

class SeatCategoryUserObserver
{
    /**
     * Handle the SeatCategoryUser "created" event.
     *
     * @param  \App\Models\SeatCategoryUser  $seatCategoryUser
     * @return void
     */
    public function created(SeatCategoryUser $seatCategoryUser)
    {
        //
    }

    /**
     * Handle the SeatCategoryUser "updated" event.
     *
     * @param  \App\Models\SeatCategoryUser  $seatCategoryUser
     * @return void
     */
    public function updated(SeatCategoryUser $seatCategoryUser)
    {
        UserApplicationEdit::create([
            'user_id' => auth()->user()->id,
            'action' => 'seat_category_update',
            'time' => Carbon::now(),
        ]);
    }

    /**
     * Handle the SeatCategoryUser "deleted" event.
     *
     * @param  \App\Models\SeatCategoryUser  $seatCategoryUser
     * @return void
     */
    public function deleted(SeatCategoryUser $seatCategoryUser)
    {
        //
    }

    /**
     * Handle the SeatCategoryUser "restored" event.
     *
     * @param  \App\Models\SeatCategoryUser  $seatCategoryUser
     * @return void
     */
    public function restored(SeatCategoryUser $seatCategoryUser)
    {
        //
    }

    /**
     * Handle the SeatCategoryUser "force deleted" event.
     *
     * @param  \App\Models\SeatCategoryUser  $seatCategoryUser
     * @return void
     */
    public function forceDeleted(SeatCategoryUser $seatCategoryUser)
    {
        //
    }
}
