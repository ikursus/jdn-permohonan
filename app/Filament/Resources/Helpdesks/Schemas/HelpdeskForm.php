<?php

namespace App\Filament\Resources\Helpdesks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HelpdeskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('ticket_id')
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                TextInput::make('category')
                    ->required()
                    ->default('General'),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('priority')
                    ->required(),
            ]);
    }
}
