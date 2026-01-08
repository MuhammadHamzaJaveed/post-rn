<?php

namespace App\Filament\Widgets;

use App\Models\PersonalDetail;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;


class AdminWidget extends BaseWidget
{
    protected function getCards(): array
    {
        /*if(auth()->user()->email == 'adminbig@uhs.com'){
            return [
                Card::make('Number of Applicants Registered', User::count()),
                Card::make('Applicants Registered Today', User::whereDate('email_verified_at', today())->count()),
                Card::make('Applicants Initiated Application', User::whereNotNull('program_id')->count()),
                Card::make('Applicants who paid Challan Fee', User::whereNotNull('transaction_id')->count()),
                Card::make('Applicants who Submitted the Application', User::whereNotNull('submitted_at')->count()),
                Card::make('Male Applicants', PersonalDetail::where('gender_id' , 1)->count()),
                Card::make('Female Applicants', PersonalDetail::where('gender_id' , 2)->count()),
                Card::make('Others Applicants', PersonalDetail::where('gender_id' , 3)->count()),
                Card::make('Applicants who applied on MBBS', User::where('program_id' , 1)->count()),
                Card::make('Applicants who applied on BDS', User::where('program_id' , 2)->count()),
                Card::make('Applicants who applied on MBBS & BDS', User::where('program_id' , 3)->count()),
            ];
        }

        if(auth()->user()->email == 'adminImageUpload@uhs.com') {
            return [
                Card::make('Applicants who have finalized the application', User::whereNotNull('transaction_id')->count()),
            ];

        }

        return [];*/
        if (auth()->user()->hasRole('College')) {
            return [
                Card::make('Principle Name', auth()->user()->father_name),
            ];
        }
        return [];

    }
}
