<?php

namespace App\Filament\Resources\LandingContents\Pages;

use App\Filament\Resources\LandingContents\LandingContentResource;
use App\Models\LandingContent;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;


class ListLandingContents extends ListRecords
{
    protected static string $resource = LandingContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('clearCache')
                ->label('Clear Landing Cache')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Clear Landing Cache?')
                ->modalDescription('This will clear the cached landing page content. The next visit will rebuild the cache from the database.')
                ->action(function () {
                    Cache::forget('landing_content');
                    \Filament\Notifications\Notification::make()
                        ->title('Landing cache cleared successfully')
                        ->success()
                        ->send();
                }),

            Actions\Action::make('preview')
                ->label('Preview Landing Page')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(fn () => route('home'), shouldOpenInNewTab: true),

            Actions\CreateAction::make()
                ->label('New Content'),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('All')
                ->badge(LandingContent::count()),
        ];

        foreach (LandingContentResource::sectionOptions() as $key => $label) {
            $tabs[$key] = Tab::make($label)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('section', $key))
                ->badge(LandingContent::where('section', $key)->count());
        }

        return $tabs;
    }
}