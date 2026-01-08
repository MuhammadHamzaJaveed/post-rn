<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Exports\FilamentUserTableExport;
use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('exports')
                ->label('Export')
                ->icon('heroicon-s-download')
                ->color('success')
                ->action(function ($livewire) : void{
                    /*$livewire->getFilteredTableQuery()->get();*/
                    $allRecords = $this->getTableRecords()->items();
                    $records = collect($allRecords);
                    $seatId =  collect($this->getTableFilterState('seat_id'))->first();
                    $isOpenMerit =    collect($this->getTableFilterState('is_open_merit'))->first();
                    Filament::notify('warning', 'Generating report...');
                    Excel::store(new FilamentUserTableExport($records,$seatId,$isOpenMerit), 'excel/user_export.xlsx', 'public');
                    Notification::make()
                        ->title('Export Generated')
                        ->body('The User Export File has been generated, and you can download it by clicking the button below.')
                        ->success()
                        ->actions([
                            \Filament\Notifications\Actions\Action::make('download')
                                ->label('Download User Export File')
                                ->url('/storage/excel/user_export.xlsx')
                        ])
                        ->sendToDatabase(auth()->user());

                })->hidden(!auth()->user()->hasRole('Super_Admin')),
            Action::make('export_report')
                ->label('Export Report')
                ->icon('heroicon-o-upload')
                ->action(function () {
                    Filament::notify('warning', 'Generating report...');
                    $artisanPath = base_path('artisan');
                    exec("php $artisanPath report:generate-excel");
                    Notification::make()
                        ->title('Report Generated')
                        ->body('The report has been generated, and you can download it by clicking the button below.')
                        ->success()
                        ->actions([
                            \Filament\Notifications\Actions\Action::make('download')
                                ->label('Download Report')
                                ->url('/storage/excel/mbbs-private-report.xlsx')
                        ])
                        ->sendToDatabase(auth()->user());
                })->hidden(!auth()->user()->hasRole('Super_Admin')),
        ];
    }
}
