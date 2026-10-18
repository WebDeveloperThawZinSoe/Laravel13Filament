<?php

namespace App\Filament\Resources\LandingContents;

use App\Filament\Resources\LandingContents\Pages;
use App\Models\LandingContent;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\ReplicateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;

class LandingContentResource extends Resource
{
    protected static ?string $model = LandingContent::class;

    public static function getNavigationIcon(): string | \BackedEnum | null
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationLabel(): string
    {
        return 'Landing Content';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function getModelLabel(): string
    {
        return 'Landing Content';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Landing Content';
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return 'title';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::active()->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Classification')
                ->description('Which section of the landing page does this item belong to?')
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\Select::make('section')
                            ->label('Section')
                            ->options(self::sectionOptions())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('item_key', null))
                            ->searchable()
                            ->helperText('Choose the page section this record belongs to.'),

                        Forms\Components\TextInput::make('item_key')
                            ->label('Item Key')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true, modifyRuleUsing: function ($rule, callable $get) {
                                return $rule->where('section', $get('section'));
                            })
                            ->helperText('Unique within the section. e.g. site_name, btn_primary, stat_members'),
                    ]),
                ]),

            Section::make('Content')
                ->description('Main text fields')
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->maxLength(255)
                            ->placeholder('Main heading / name'),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->maxLength(255)
                            ->placeholder('Secondary heading'),
                    ]),
                    Forms\Components\Textarea::make('content')
                        ->label('Content / Description')
                        ->rows(4)
                        ->columnSpanFull()
                        ->placeholder('Long description, testimonial text, etc.'),
                ]),

            Section::make('Media & Links')
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('image_url')
                            ->label('Image URL')
                            ->url()
                            ->maxLength(500)
                            ->placeholder('https://example.com/logo.png'),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon')
                            ->maxLength(100)
                            ->placeholder('fas fa-bolt / fab fa-telegram / 🎁')
                            ->helperText('Font Awesome class OR an emoji.'),
                    ]),
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('link_url')
                            ->label('Link URL')
                            ->maxLength(500)
                            ->placeholder('https://t.me/yourchannel'),
                        Forms\Components\TextInput::make('link_text')
                            ->label('Link / Button Text')
                            ->maxLength(100)
                            ->placeholder('ဆက်သွယ်ရန်, HOT, ...'),
                    ]),
                ]),

            Section::make('Values')
                ->description('For stats, promotions, testimonials, badges')
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Value')
                            ->maxLength(100)
                            ->placeholder('50000 / 99 / 5 / 50%'),
                        Forms\Components\TextInput::make('extra_value')
                            ->label('Extra Value')
                            ->maxLength(100)
                            ->placeholder('+ / % / min / Max: 100,000 Ks'),
                    ]),
                ]),

            Section::make('Display Settings')
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower number = appears first.'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Inactive items will NOT appear on the landing page.'),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section')
                    ->badge()
                    ->colors([
                        'primary' => 'brand',
                        'success' => 'hero',
                        'warning' => 'stats',
                        'info'    => 'services',
                        'danger'  => 'promotions',
                        'gray'    => fn ($state) => ! in_array($state, ['brand', 'hero', 'stats', 'services', 'promotions']),
                    ])
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('item_key')
                    ->label('Key')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->limit(40)
                    ->searchable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->limit(20)
                    ->placeholder('—')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section')
                    ->options(self::sectionOptions())
                    ->multiple(),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->placeholder('All')
                    ->trueLabel('Only Active')
                    ->falseLabel('Only Inactive'),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('activate')
                        ->label('Activate')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (LandingContent $record) => ! $record->is_active)
                        ->action(fn (LandingContent $record) => tap($record, fn ($r) => $r->update(['is_active' => true]))),
                    Action::make('deactivate')
                        ->label('Deactivate')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->visible(fn (LandingContent $record) => $record->is_active)
                        ->action(fn (LandingContent $record) => tap($record, fn ($r) => $r->update(['is_active' => false]))),
                    ReplicateAction::make()
                        ->excludeAttributes(['created_at', 'updated_at', 'deleted_at'])
                        ->form(fn (LandingContent $record) => [
                            Forms\Components\TextInput::make('item_key')
                                ->label('New Item Key')
                                ->default($record->item_key . '_copy')
                                ->required()
                                ->maxLength(100)
                                ->unique(
                                    table: LandingContent::class,
                                    column: 'item_key',
                                    modifyRuleUsing: fn ($rule) => $rule->where('section', $record->section)
                                ),
                        ])
                        ->beforeReplicaSaved(function (LandingContent $replica, array $data) {
                            $replica->item_key = $data['item_key'];
                        }),
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
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->persistSortInSession()
            ->striped()
            ->paginated([10, 25, 50, 100, 'all']);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('section')
            ->orderBy('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLandingContents::route('/'),
            'create' => Pages\CreateLandingContent::route('/create'),
            'edit'   => Pages\EditLandingContent::route('/{record}/edit'),
        ];
    }

    public static function sectionOptions(): array
    {
        return [
            LandingContent::SECTION_BRAND        => 'Brand',
            LandingContent::SECTION_HERO         => 'Hero',
            LandingContent::SECTION_STATS        => 'Stats',
            LandingContent::SECTION_SERVICES     => 'Services',
            LandingContent::SECTION_STEPS        => 'Steps',
            LandingContent::SECTION_PROMOTIONS   => 'Promotions',
            LandingContent::SECTION_TESTIMONIALS => 'Testimonials',
            LandingContent::SECTION_AGENT        => 'Agent',
            LandingContent::SECTION_CONTACT      => 'Contact',
            LandingContent::SECTION_FOOTER       => 'Footer',
        ];
    }
}