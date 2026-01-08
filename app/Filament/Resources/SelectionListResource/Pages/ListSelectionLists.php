<?php

namespace App\Filament\Resources\SelectionListResource\Pages;
use App\Filament\Resources\SelectionListResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSelectionLists extends ListRecords
{
    protected static string $resource = SelectionListResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
