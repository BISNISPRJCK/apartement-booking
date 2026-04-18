<?php

namespace App\Filament\Resources\Roomfeatures\Pages;

use App\Filament\Resources\Roomfeatures\RoomfeatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRoomfeatures extends ListRecords
{
    protected static string $resource = RoomfeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
