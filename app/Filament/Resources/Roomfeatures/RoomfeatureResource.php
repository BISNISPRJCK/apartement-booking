<?php

namespace App\Filament\Resources\Roomfeatures;

use App\Filament\Resources\Roomfeatures\Pages\CreateRoomfeature;
use App\Filament\Resources\Roomfeatures\Pages\EditRoomfeature;
use App\Filament\Resources\Roomfeatures\Pages\ListRoomfeatures;
use App\Filament\Resources\Roomfeatures\Schemas\RoomfeatureForm;
use App\Filament\Resources\Roomfeatures\Tables\RoomfeaturesTable;
use App\Models\Roomfeature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RoomfeatureResource extends Resource
{
    protected static ?string $model = Roomfeature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Room Features';

    public static function form(Schema $schema): Schema
    {
        return RoomfeatureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoomfeaturesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoomfeatures::route('/'),
            'create' => CreateRoomfeature::route('/create'),
            'edit' => EditRoomfeature::route('/{record}/edit'),
        ];
    }
}
