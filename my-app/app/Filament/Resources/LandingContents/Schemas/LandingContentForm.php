<?php

namespace App\Filament\Resources\LandingContents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LandingContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('section')
                    ->required(),
                TextInput::make('item_key')
                    ->required(),
                TextInput::make('title'),
                TextInput::make('subtitle'),
                Textarea::make('content')
                    ->columnSpanFull(),
                FileUpload::make('image_url')
                    ->image(),
                TextInput::make('link_url')
                    ->url(),
                TextInput::make('link_text'),
                TextInput::make('icon'),
                TextInput::make('value'),
                TextInput::make('extra_value'),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
