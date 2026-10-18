<?php

namespace App\Filament\Resources\LandingContents\Pages;

use App\Filament\Resources\LandingContents\LandingContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditLandingContent extends EditRecord
{
    protected static string $resource = LandingContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->label('View on Site')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(fn () => route('home'), shouldOpenInNewTab: true),

            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        Cache::forget('landing_content');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Landing content updated successfully';
    }
}