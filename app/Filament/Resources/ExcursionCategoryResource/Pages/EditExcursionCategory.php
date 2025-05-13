<?php

namespace App\Filament\Resources\ExcursionCategoryResource\Pages;

use App\Filament\Resources\ExcursionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExcursionCategory extends EditRecord
{
    protected static string $resource = ExcursionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
