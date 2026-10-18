<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('file_name')
                    ->required(),
                TextInput::make('mime_type')
                    ->required(),
                TextInput::make('extension')
                    ->required(),
                TextInput::make('disk')
                    ->required()
                    ->default('public'),
                TextInput::make('path')
                    ->required(),
                TextInput::make('url')
                    ->url()
                    ->required(),
                TextInput::make('size')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('type')
                    ->required()
                    ->default('image'),
                TextInput::make('width')
                    ->numeric(),
                TextInput::make('height')
                    ->numeric(),
                TextInput::make('duration')
                    ->numeric(),
                TextInput::make('collection'),
                TextInput::make('alt_text'),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('meta')
                    ->columnSpanFull(),
                TextInput::make('uploaded_by')
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
