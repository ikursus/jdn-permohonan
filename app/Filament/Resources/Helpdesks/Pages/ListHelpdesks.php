<?php

namespace App\Filament\Resources\Helpdesks\Pages;

use App\Filament\Resources\Helpdesks\HelpdeskResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHelpdesks extends ListRecords
{
    protected static string $resource = HelpdeskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
