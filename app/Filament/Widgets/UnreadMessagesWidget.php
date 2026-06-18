<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UnreadMessagesWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $unreadCount = ContactMessage::where('is_read', false)->count();

        return [
            Stat::make('Okunmamış Mesajlar', $unreadCount)
                ->description('Yanıt bekleyen iletişim mesajları')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger')
                ->chart([2, 4, 6, 3, 5, $unreadCount])
                ->url(ContactMessageResource::getUrl()),
        ];
    }
}
