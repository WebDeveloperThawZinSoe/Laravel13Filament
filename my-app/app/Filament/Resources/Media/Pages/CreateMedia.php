<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use App\Models\Media;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto-fill file metadata if not set
        if (! empty($data['path'])) {
            $disk = 'public';
            $fullPath = Storage::disk($disk)->path($data['path']);

            $data['disk']      = $disk;
            $data['file_name'] = $data['file_name'] ?? basename($data['path']);
            $data['url']       = Storage::disk($disk)->url($data['path']);
            $data['size']      = $data['size'] ?? (file_exists($fullPath) ? filesize($fullPath) : 0);

            if (empty($data['mime_type']) && file_exists($fullPath)) {
                $data['mime_type'] = mime_content_type($fullPath);
            }

            if (empty($data['extension'])) {
                $data['extension'] = pathinfo($data['path'], PATHINFO_EXTENSION);
            }

            if (empty($data['type'])) {
                $data['type'] = Media::detectType($data['mime_type'] ?? '', $data['extension'] ?? '');
            }

            // Image dimensions
            if (($data['type'] ?? '') === Media::TYPE_IMAGE && file_exists($fullPath)) {
                $info = @getimagesize($fullPath);
                if ($info) {
                    $data['width']  = $data['width']  ?? $info[0];
                    $data['height'] = $data['height'] ?? $info[1];
                }
            }

            // Default display name = filename
            if (empty($data['name'])) {
                $data['name'] = pathinfo($data['file_name'], PATHINFO_FILENAME);
            }
        }

        $data['uploaded_by'] = $data['uploaded_by'] ?? auth()->id();

        return $data;
    }
}