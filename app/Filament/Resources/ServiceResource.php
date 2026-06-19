<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';

    protected static string | \UnitEnum | null $navigationGroup = 'İçerik Yönetimi';

    protected static ?string $navigationLabel = 'Hizmetler';

    protected static ?string $modelLabel = 'Hizmet';

    protected static ?string $pluralModelLabel = 'Hizmetler';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Hizmet')
                    ->tabs([
                        Tabs\Tab::make('Genel Bilgiler')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Başlık')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                Forms\Components\Textarea::make('short_description')
                                    ->label('Kısa Açıklama')
                                    ->maxLength(280)
                                    ->rows(3),

                                Forms\Components\RichEditor::make('description')
                                    ->label('Detaylı Açıklama')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('icon')
                                    ->label('İkon')
                                    ->placeholder('fa fa-heart')
                                    ->maxLength(100),

                                Forms\Components\FileUpload::make('image')
                                    ->label('Görsel')
                                    ->image()
                                    ->directory('services')
                                    ->maxSize(2048)
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('4:3')
                                    ->imageResizeTargetWidth('800')
                                    ->imageResizeTargetHeight('600'),

                                Forms\Components\TextInput::make('price')
                                    ->label('Fiyat')
                                    ->numeric()
                                    ->prefix('₺')
                                    ->maxValue(99999.99),

                                Forms\Components\TextInput::make('duration')
                                    ->label('Süre')
                                    ->placeholder('50 dakika')
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('order')
                                    ->label('Sıra')
                                    ->numeric()
                                    ->default(0),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true),
                            ])
                            ->columns(2),

                        Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->label('SEO Başlık')
                                    ->maxLength(70)
                                    ->placeholder('Sayfa başlığını özelleştirin'),

                                Forms\Components\Textarea::make('seo_description')
                                    ->label('SEO Açıklama')
                                    ->maxLength(160)
                                    ->rows(3)
                                    ->placeholder('Arama motorlarında görünecek açıklama'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Fiyat')
                    ->money('TRY')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Süre'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Durum')
                    ->placeholder('Tümü')
                    ->trueLabel('Aktif')
                    ->falseLabel('Pasif'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
