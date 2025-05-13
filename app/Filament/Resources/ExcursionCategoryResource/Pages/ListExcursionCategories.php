<?php

namespace App\Filament\Resources\ExcursionCategoryResource\Pages;

use App\Filament\Resources\ExcursionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExcursionCategories extends ListRecords
{
    protected static string $resource = ExcursionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
