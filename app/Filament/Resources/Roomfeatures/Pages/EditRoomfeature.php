<?php

namespace App\Filament\Resources\Roomfeatures\Pages;

use App\Filament\Resources\Roomfeatures\RoomfeatureResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRoomfeature extends EditRecord
{
    protected static string $resource = RoomfeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
