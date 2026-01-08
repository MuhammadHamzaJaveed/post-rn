<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\AdmissionTest;
use App\Models\CollegePreference;
use App\Models\Media;
use App\Models\PersonalDetail;
use App\Models\Qualification;
use App\Models\SeatCategoryUser;
use App\Observers\AdmissionTestObserver;
use App\Observers\CollegePreferenceObserver;
use App\Observers\MediaObserver;
use App\Observers\PersonalDetailObserver;
use App\Observers\QualificationObserver;
use App\Observers\SeatCategoryUserObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
