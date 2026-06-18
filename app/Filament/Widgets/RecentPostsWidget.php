<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentPostsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Son Yayınlanan Yazılar';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Post::published()
                    ->latest('published_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->limit(50)
                    ->url(fn (Post $record): string => PostResource::getUrl('edit', ['record' => $record])),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Yayın Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('views')
                    ->label('Görüntülenme')
                    ->numeric()
                    ->sortable(),
            ])
            ->paginated(false)
            ->defaultSort('published_at', 'desc');
    }
}
