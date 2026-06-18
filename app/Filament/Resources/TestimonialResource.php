<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string | \UnitEnum | null $navigationGroup = 'İçerik Yönetimi';

    protected static ?string $navigationLabel = 'Referanslar';

    protected static ?string $modelLabel = 'Referans';

    protected static ?string $pluralModelLabel = 'Referanslar';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Referans Bilgileri')
                    ->schema([
                        Forms\Components\TextInput::make('author_name')
                            ->label('Yazar Adı')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('content')
                            ->label('İçerik')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('rating')
                            ->label('Puan')
                            ->options([
                                1 => '1 - Çok Kötü',
                                2 => '2 - Kötü',
                                3 => '3 - Orta',
                                4 => '4 - İyi',
                                5 => '5 - Çok İyi',
                            ])
                            ->nullable(),

                        Forms\Components\Toggle::make('is_approved')
                            ->label('Onaylı')
                            ->default(false),

                        Forms\Components\TextInput::make('order')
                            ->label('Sıra')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Yazar')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('content')
                    ->label('İçerik')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Puan')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_approved')
                    ->label('Onaylı'),

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
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('Onay Durumu')
                    ->placeholder('Tümü')
                    ->trueLabel('Onaylı')
                    ->falseLabel('Onaysız'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Onayla')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Testimonial $record) => $record->update(['is_approved' => true]))
                    ->visible(fn (Testimonial $record) => !$record->is_approved)
                    ->requiresConfirmation(),

                Tables\Actions\Action::make('disapprove')
                    ->label('Onayı Kaldır')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn (Testimonial $record) => $record->update(['is_approved' => false]))
                    ->visible(fn (Testimonial $record) => $record->is_approved)
                    ->requiresConfirmation(),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
