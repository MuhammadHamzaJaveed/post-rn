<?php

namespace App\Filament\Resources\SelectionListResource\Pages;
use App\Filament\Resources\SelectionListResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSelectionList extends EditRecord
{
    protected static string $resource = SelectionListResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
