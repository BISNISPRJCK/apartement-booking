<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('room_number')->label('Room Number')->required(),
                Select::make('room_category_id')
                    ->label('Room Category')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('type')->label('Room Type')->label('Room Type')->placeholder('Standar / Deluxe / Suite'),
                TextInput::make('price')->label('Room Price')->required(),
                Select::make('status')->options([
                    'available' => 'Available',
                    'booked' => 'Booked',
                ])->required(),

                FileUpload::make('image')->label('Room Image')->image()->directory('rooms')->imagePreviewHeight(200)->required(),

                TextArea::make('description')->label('Description')->columnSpanFull()
            ]);
    }
}
