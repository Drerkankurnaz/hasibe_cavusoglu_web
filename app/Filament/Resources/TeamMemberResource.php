<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Actions;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

    protected static string | \UnitEnum | null $navigationGroup = 'İçerik Yönetimi';

    protected static ?string $navigationLabel = 'Ekip Üyeleri';

    protected static ?string $modelLabel = 'Ekip Üyesi';

    protected static ?string $pluralModelLabel = 'Ekip Üyeleri';

    protected static ?int $navigationSort = 9;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kişisel Bilgiler')
                    ->schema([
                        Components\TextInput::make('name')
                            ->label('Ad Soyad')
                            ->required()
                            ->maxLength(255),

                        Components\TextInput::make('title')
                            ->label('Unvan')
                            ->required()
                            ->maxLength(255),

                        Components\Textarea::make('bio')
                            ->label('Biyografi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Components\FileUpload::make('photo')
                            ->label('Fotoğraf')
                            ->image()
                            ->directory('team-members')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('400')
                            ->imageResizeTargetHeight('400')
                            ->nullable(),

                        Components\TextInput::make('order')
                            ->label('Sıra')
                            ->numeric()
                            ->default(0),

                        Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('Sosyal Medya Hesapları')
                    ->schema([
                        Components\Repeater::make('socials')
                            ->label('Sosyal Medya')
                            ->schema([
                                Components\TextInput::make('platform')
                                    ->label('Platform')
                                    ->required()
                                    ->placeholder('Ör: Facebook, Instagram, Twitter'),

                                Components\TextInput::make('url')
                                    ->label('URL')
                                    ->required()
                                    ->url()
                                    ->placeholder('https://...'),

                                Components\TextInput::make('icon')
                                    ->label('İkon Sınıfı')
                                    ->placeholder('Ör: fa fa-facebook, fa fa-instagram')
                                    ->helperText('Font Awesome ikon sınıfı'),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->addActionLabel('Sosyal Medya Ekle')
                            ->reorderable()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Fotoğraf')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Unvan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktif'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
