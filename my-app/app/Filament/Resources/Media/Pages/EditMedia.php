<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use App\Models\Media;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditMedia extends EditRecord
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! empty($data['path'])) {
            $disk = 'public';
            $fullPath = Storage::disk($disk)->path($data['path']);

            $data['disk'] = $disk;
            $data['url']  = Storage::disk($disk)->url($data['path']);

            if (file_exists($fullPath)) {
                $data['size']      = filesize($fullPath);
                $data['mime_type'] = $data['mime_type'] ?? mime_content_type($fullPath);
                $data['extension'] = $data['extension'] ?? pathinfo($data['path'], PATHINFO_EXTENSION);
            }

            if (($data['type'] ?? '') === Media::TYPE_IMAGE && file_exists($fullPath)) {
                $info = @getimagesize($fullPath);
                if ($info) {
                    $data['width']  = $info[0];
                    $data['height'] = $info[1];
                }
            }
        }

        return $data;
    }
}