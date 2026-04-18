<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\CheckboxList as ComponentsCheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\RichEditor;


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
                TextInput::make('capacity')
                    ->label('Capacity (Guest)')
                    ->numeric()
                    ->required(),
                Select::make('status')->options([
                    'available' => 'Available',
                    'booked' => 'Booked',
                ])->required(),

                ComponentsCheckboxList::make('features')
                    ->label('Room Features')
                    ->relationship('features', 'name')
                    ->columns(2),

                FileUpload::make('image')->label('Room Image')->image()->disk('public')->directory('rooms')->imagePreviewHeight(200)->required(),

                RichEditor::make('description')
                    ->label('Description')
                    ->columnSpanFull()
            ]);
    }
}
