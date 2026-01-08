<?php

namespace App\Filament\Resources\CollegeResource\Pages;

use App\Filament\Resources\CollegeResource;
use App\Imports\CollegeImport;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Actions\Action;

class ListColleges extends ListRecords
{
    protected static string $resource = CollegeResource::class;

    protected function getActions(): array
    {

        return [
            Actions\CreateAction::make(),
            //custom Action
            Actions\Action::make('import')
                ->label('Import')
                ->icon('heroicon-o-upload')
                ->form([
                    FileUpload::make('import_file')
                        ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                        ->label('Excel File')
                        ->hint('Only Excel files are allowed. Download the sample file.')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintAction(
                            Action::make('downloadSample')
                                ->label('Download Sample')
                                ->url(asset('sample.xlsx'))
                                ->color('success')
                                ->icon('heroicon-o-download')
                                ->openUrlInNewTab()
                        )
                        ->required(),
                ])->action(function ($data) {
                    $filePath = $data['import_file'];
                    // Import the Excel file
                    Excel::import(new CollegeImport, $filePath);

                    Filament::notify('success', 'File imported successfully!');
                }),

            /*Action::make('import')
                ->button()
                ->form([
                    FileUpload::make('import_file')
                        ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                        ->label('Excel File')
                        ->hint('Only Excel files are allowed. Download the sample file.')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintAction(
                            Action::make('downloadSample')
                                ->label('Download Sample')
                                ->url(asset('sample.xlsx'))
                                ->color('success')
                                ->icon('heroicon-o-download')
                                ->openUrlInNewTab()
                        )
                        ->required(),

                ])
                ->action(function ($data) {
                    $filePath = $data['import_file'];
                    // Import the Excel file
                    Excel::import(new CollegeImport, $filePath);

                    Filament::notify('success', 'File imported successfully!');
                }),*/
        ];
    }
}
