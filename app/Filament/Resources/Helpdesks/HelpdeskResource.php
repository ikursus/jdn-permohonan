<?php

namespace App\Filament\Resources\Helpdesks;

use App\Filament\Resources\Helpdesks\Pages\CreateHelpdesk;
use App\Filament\Resources\Helpdesks\Pages\EditHelpdesk;
use App\Filament\Resources\Helpdesks\Pages\ListHelpdesks;
use App\Filament\Resources\Helpdesks\Schemas\HelpdeskForm;
use App\Filament\Resources\Helpdesks\Tables\HelpdesksTable;
use App\Models\Helpdesk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HelpdeskResource extends Resource
{
    protected static ?string $model = Helpdesk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Helpdesk';

    public static function form(Schema $schema): Schema
    {
        return HelpdeskForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HelpdesksTable::configure($table);
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
            'index' => ListHelpdesks::route('/'),
            'create' => CreateHelpdesk::route('/create'),
            'edit' => EditHelpdesk::route('/{record}/edit'),
        ];
    }
}
