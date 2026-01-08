<?php

namespace App\Filament\Resources\MeritListFromCollegeResource\Pages;

use App\Filament\Resources\MeritListFromCollegeResource;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Widgets\StatsOverviewWidget\Card;

class ListMeritListFromColleges extends ListRecords
{
    protected static string $resource = MeritListFromCollegeResource::class;

    protected function getActions(): array
    {

        return [
            /*Actions\CreateAction::make(),*/
            Action::make('export_report')
                ->label('Export Report')
                ->icon('heroicon-o-upload')
                ->action(function () {
                    Filament::notify('warning', 'Generating report...');
                    // Use the full path to the artisan file
                    $artisanPath = base_path('artisan');
                    exec("php $artisanPath meritlist:from-colleges");
                    Notification::make()
                        ->title('Report Generated')
                        ->body('The report has been generated, and you can download it by clicking the button below.')
                        ->success()
                        ->actions([
                            \Filament\Notifications\Actions\Action::make('download')
                                ->label('Download Report')
                                ->url('/storage/report/listfromcolleges.xlsx') // Make sure this URL is correct and accessible
                        ])
                        ->sendToDatabase(auth()->user());
                })
                ->visible(auth()->user()->hasRole(config('role_names.roles.super_admin'))),
            // notify user that the report has been generated and you download it from the storage folder
        ];
    }


    protected function getHeaderWidgets(): array
    {
        if (
            auth()->user()->hasRole('College')
            || auth()->user()->hasRole('Admin')
        )
        {
            return [
                MeritListFromCollegeResource\Widgets\CollegeNotice::class
            ];
        }
        return [

        ];
    }
}
