<?php

namespace App\Filament\Resources\Helpdesks\Pages;

use App\Filament\Resources\Helpdesks\HelpdeskResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHelpdesk extends CreateRecord
{
    protected static string $resource = HelpdeskResource::class;
}
