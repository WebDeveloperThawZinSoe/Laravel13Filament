<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use App\Models\Media;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Upload Media'),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('All')->badge(Media::count()),
        ];

        foreach (Media::TYPES as $key => $label) {
            $tabs[$key] = Tab::make($label)
                ->modifyQueryUsing(fn (Builder $q) => $q->where('type', $key))
                ->badge(Media::where('type', $key)->count());
        }

        return $tabs;
    }
}