<?php

namespace App\Filament\Resources\MeritListFromCollegeResource\Pages;

use App\Filament\Resources\MeritListFromCollegeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeritListFromCollege extends EditRecord
{
    protected static string $resource = MeritListFromCollegeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
