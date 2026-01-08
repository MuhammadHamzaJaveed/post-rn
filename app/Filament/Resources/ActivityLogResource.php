<?php

namespace App\Filament\Resources;

use AlexJustesen\FilamentSpatieLaravelActivitylog\Resources\ActivityResource;

class ActivityLogResource extends ActivityResource
{
    /**
     * @return bool
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.admin'));
    }
}
