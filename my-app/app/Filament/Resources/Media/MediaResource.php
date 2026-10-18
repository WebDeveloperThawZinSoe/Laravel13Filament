<?php

namespace App\Filament\Resources\Media;

use App\Filament\Resources\Media\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    /* =========================================================
     |  NAVIGATION
     ========================================================= */
    public static function getNavigationIcon(): string | \BackedEnum | null
    {
        return 'heroicon-o-photo';
    }

    public static function getNavigationLabel(): string
    {
        return 'Media Library';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function getModelLabel(): string
    {
        return 'Media';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Media Library';
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return 'name';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::active()->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    /* =========================================================
     |  FORM
     ========================================================= */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Upload File')
                ->description('Upload an image, video, or document. Max 20MB.')
                ->schema([
                    FileUpload::make('path')
                        ->label('File')
                        ->required()
                        ->disk('public')
                        ->directory('media')
                        ->visibility('public')
                        ->maxSize(20480)
                        ->acceptedFileTypes([
                            'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
                            'video/mp4', 'video/webm', 'video/ogg', 'video/quicktime',
                            'audio/mpeg', 'audio/wav', 'audio/ogg',
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ])
                        ->imagePreviewHeight('200')
                        ->panelAspectRatio('16:9')
                        ->panelLayout('integrated')
                        ->storeFileNamesIn('original_filename')
                        ->afterStateUpdated(function ($state, Set $set) {
                            if (! $state instanceof TemporaryUploadedFile) {
                                return;
                            }

                            $set('file_name', $state->getClientOriginalName());
                            $set('mime_type', $state->getMimeType());
                            $set('extension', $state->getClientOriginalExtension());
                            $set('size',      $state->getSize());
                            $set('type',      Media::detectType(
                                $state->getMimeType() ?? '',
                                $state->getClientOriginalExtension() ?? ''
                            ));
                            $set('name', pathinfo($state->getClientOriginalName(), PATHINFO_FILENAME));
                        })
                        ->columnSpanFull(),
                ]),

            Section::make('File Info')
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Display Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Hero Banner'),

                        Forms\Components\Select::make('type')
                            ->label('Media Type')
                            ->options(Media::TYPES)
                            ->default(Media::TYPE_IMAGE)
                            ->required(),

                        Forms\Components\Select::make('collection')
                            ->label('Collection')
                            ->options(Media::COLLECTIONS)
                            ->default('general')
                            ->searchable(),

                        Forms\Components\TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('width')->label('Width (px)')->numeric(),
                        Forms\Components\TextInput::make('height')->label('Height (px)')->numeric(),
                        Forms\Components\TextInput::make('duration')->label('Duration (seconds)')->numeric(),
                    ]),
                ]),

            Section::make('Details')
                ->schema([
                    Forms\Components\Textarea::make('description')
                        ->label('Description')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            Section::make('Display Settings')
                ->schema([
                    Grid::make(3)->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
                ]),
        ]);
    }

    /* =========================================================
     |  TABLE
     ========================================================= */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('url')
                    ->label('Preview')
                    ->height(60)
                    ->width(80)
                    ->state(fn (Media $record) => $record->is_image ? $record->url : null)
                    ->defaultImageUrl(fn (Media $record) => match ($record->type) {
                        Media::TYPE_VIDEO    => 'https://img.icons8.com/color/96/video-file.png',
                        Media::TYPE_AUDIO    => 'https://img.icons8.com/color/96/audio-file.png',
                        Media::TYPE_DOCUMENT => 'https://img.icons8.com/color/96/document.png',
                        default              => 'https://img.icons8.com/color/96/file.png',
                    })
                    ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 6px;']),

                Tables\Columns\TextColumn::make('file_name')
                    ->label('File')
                    ->searchable()
                    ->limit(30)
                    ->description(fn (Media $record) => $record->human_size)
                    ->badge()
                    ->color(fn (Media $record) => match ($record->type) {
                        Media::TYPE_IMAGE    => 'info',
                        Media::TYPE_VIDEO    => 'warning',
                        Media::TYPE_AUDIO    => 'success',
                        Media::TYPE_DOCUMENT => 'primary',
                        default              => 'gray',
                    })
                    ->formatStateUsing(fn (Media $record) => strtoupper($record->extension)),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'info'    => Media::TYPE_IMAGE,
                        'warning' => Media::TYPE_VIDEO,
                        'success' => Media::TYPE_AUDIO,
                        'primary' => Media::TYPE_DOCUMENT,
                        'gray'    => Media::TYPE_OTHER,
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('collection')
                    ->label('Collection')
                    ->badge()
                    ->color('gray')
                    ->placeholder('—')
                    ->sortable(),

                /* =========================================================
                 |  ✅ URL COLUMN — Copy button ဖြင့်
                 ========================================================= */
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(30)
                    ->tooltip(fn (Media $record) => $record->url)
                    ->copyable()
                    ->copyableState(fn (Media $record) => $record->url)
                    ->copyMessage('URL copied!')
                    ->copyMessageDuration(1500)
                    ->icon('heroicon-m-clipboard')
                    ->iconPosition('after')
                    ->iconColor('info')
                    ->extraAttributes(fn (Media $record) => [
                        'class'      => 'cursor-pointer',
                        'x-on:click' => 'navigator.clipboard.writeText($el.dataset.url); $tooltip("URL copied!", { timeout: 1500 })',
                        'data-url'   => $record->url ?? '',
                        'title'      => 'Click to copy URL',
                    ]),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(Media::TYPES)
                    ->multiple(),

                Tables\Filters\SelectFilter::make('collection')
                    ->options(Media::COLLECTIONS)
                    ->multiple(),

                Tables\Filters\TernaryFilter::make('is_active')->label('Active'),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),

                    /* ✅ Copy URL Action — သိသာတဲ့ button */
                    Action::make('copyUrl')
                        ->label('Copy URL')
                        ->icon('heroicon-o-clipboard-document')
                        ->color('info')
                        ->extraAttributes(fn (Media $record) => [
                            'x-on:click' => 'navigator.clipboard.writeText($el.dataset.url); $tooltip("URL copied!", { timeout: 1500 })',
                            'data-url'   => $record->url ?? '',
                        ]),

                    Action::make('copyMarkdown')
                        ->label('Copy Markdown')
                        ->icon('heroicon-o-code-bracket')
                        ->color('gray')
                        ->extraAttributes(fn (Media $record) => [
                            'x-on:click' => 'navigator.clipboard.writeText($el.dataset.md); $tooltip("Markdown copied!", { timeout: 1500 })',
                            'data-md'    => '![' . ($record->alt_text ?? '') . '](' . ($record->url ?? '') . ')',
                        ]),

                    Action::make('copyHtml')
                        ->label('Copy HTML')
                        ->icon('heroicon-o-code-bracket-square')
                        ->color('gray')
                        ->extraAttributes(fn (Media $record) => [
                            'x-on:click' => 'navigator.clipboard.writeText($el.dataset.html); $tooltip("HTML copied!", { timeout: 1500 })',
                            'data-html'  => '<img src="' . ($record->url ?? '') . '" alt="' . ($record->alt_text ?? '') . '" />',
                        ]),

                    Action::make('openFile')
                        ->label('Open in New Tab')
                        ->icon('heroicon-o-arrow-top-right-on-square')
                        ->color('success')
                        ->url(fn (Media $record) => $record->url, shouldOpenInNewTab: true),

                    Action::make('deactivate')
                        ->label('Deactivate')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->visible(fn (Media $record) => $record->is_active)
                        ->action(fn (Media $record) => $record->update(['is_active' => false])),

                    Action::make('activate')
                        ->label('Activate')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (Media $record) => ! $record->is_active)
                        ->action(fn (Media $record) => $record->update(['is_active' => true])),

                    DeleteAction::make(),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->action(fn ($records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion(),

                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([12, 24, 48, 96, 'all']);
    }

    /* =========================================================
     |  QUERY
     ========================================================= */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('uploadedBy');
    }

    /* =========================================================
     |  PAGES
     ========================================================= */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit'   => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}