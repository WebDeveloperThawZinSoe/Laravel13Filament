<?php

namespace App\Filament\Resources\LandingContents\Pages;

use App\Filament\Resources\LandingContents\LandingContentResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

class CreateLandingContent extends CreateRecord
{
    protected static string $resource = LandingContentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto-assign sort_order if not given
        if (empty($data['sort_order'])) {
            $data['sort_order'] = (int) \App\Models\LandingContent::where('section', $data['section'])->max('sort_order') + 1;
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        Cache::forget('landing_content');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Landing content created successfully';
    }
}