<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['name'] = $data['original_name'];
        return $data;
    }
}
