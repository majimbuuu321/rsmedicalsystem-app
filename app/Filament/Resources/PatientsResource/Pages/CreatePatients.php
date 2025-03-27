<?php

namespace App\Filament\Resources\PatientsResource\Pages;

use App\Filament\Resources\PatientsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePatients extends CreateRecord
{
    protected static string $resource = PatientsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification {
        return Notification::make()
                ->success()
                ->title('Patient Information is successfully created.');
    }

}
