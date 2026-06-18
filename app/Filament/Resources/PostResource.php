<?php

namespace App\Filament\Resources;

use App\Enums\PostStatus;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | \UnitEnum | null $navigationGroup = 'İçerik Yönetimi';

    protected static ?string $navigationLabel = 'Blog Yazıları';

    protected static ?string $modelLabel = 'Yazı';

    protected static ?string $pluralModelLabel = 'Blog Yazıları';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Blog Yazısı')
                    ->tabs([
                        Tabs\Tab::make('İçerik')
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

                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Kategori Adı')
                                            ->required()
                                            ->maxLength(255),
                                    ]),

                                Forms\Components\Select::make('tags')
                                    ->label('Etiketler')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Etiket Adı')
                                            ->required()
                                            ->maxLength(255),
                                    ]),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Özet')
                                    ->maxLength(300)
                                    ->rows(3),

                                Forms\Components\RichEditor::make('body')
                                    ->label('İçerik')
                                    ->required()
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('cover_image')
                                    ->label('Kapak Görseli')
                                    ->image()
                                    ->directory('posts')
                                    ->maxSize(2048),
                            ])
                            ->columns(2),

                        Tabs\Tab::make('Yayın Ayarları')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Durum')
                                    ->options(PostStatus::class)
                                    ->default(PostStatus::Draft)
                                    ->required(),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Yayın Tarihi')
                                    ->displayFormat('d.m.Y H:i'),

                                Forms\Components\TextInput::make('reading_time')
                                    ->label('Okuma Süresi (dk)')
                                    ->numeric()
                                    ->suffix('dakika'),
                            ]),

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
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn (PostStatus $state): string => match ($state) {
                        PostStatus::Draft => 'warning',
                        PostStatus::Published => 'success',
                    })
                    ->formatStateUsing(fn (PostStatus $state): string => match ($state) {
                        PostStatus::Draft => 'Taslak',
                        PostStatus::Published => 'Yayında',
                    }),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Yayın Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('views')
                    ->label('Görüntülenme')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options(PostStatus::class),

                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\Action::make('publish')
                    ->label('Yayınla')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Yazıyı Yayınla')
                    ->modalDescription('Bu yazıyı yayınlamak istediğinize emin misiniz?')
                    ->visible(fn (Post $record): bool => $record->status === PostStatus::Draft)
                    ->action(function (Post $record): void {
                        $record->update([
                            'status' => PostStatus::Published,
                            'published_at' => $record->published_at ?? now(),
                        ]);
                    }),
                Tables\Actions\Action::make('unpublish')
                    ->label('Taslağa Al')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Taslağa Al')
                    ->modalDescription('Bu yazıyı taslağa almak istediğinize emin misiniz?')
                    ->visible(fn (Post $record): bool => $record->status === PostStatus::Published)
                    ->action(function (Post $record): void {
                        $record->update([
                            'status' => PostStatus::Draft,
                        ]);
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
