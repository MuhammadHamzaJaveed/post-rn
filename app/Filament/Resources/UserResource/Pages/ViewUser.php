<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Helpers\MediaHelper;
use Exception;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    public $cnic;

    public $image;

    protected static string $resource = UserResource::class;

    /**
     * @return array
     *
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [];
    }

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->fillForm();

        $this->previousUrl = url()->previous();

        if ($this->record->userChallanImage) {
            $this->cnic = MediaHelper::GetImageUrl($this->record->userChallanImage->path);
        }

        if ($this->record->image) {
            $this->image = MediaHelper::GetImageUrl($this->record->image->path);
        }

    }

    protected function getRelationManagers(): array
    {
        return [];
    }
}
