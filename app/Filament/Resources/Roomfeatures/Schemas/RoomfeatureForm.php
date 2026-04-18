<?php

namespace App\Filament\Resources\Roomfeatures\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class RoomfeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Feature')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
