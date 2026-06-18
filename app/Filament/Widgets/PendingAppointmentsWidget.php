<?php

namespace App\Filament\Widgets;

use App\Enums\AppointmentStatus;
use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PendingAppointmentsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $pendingCount = Appointment::where('status', AppointmentStatus::Pending)->count();

        return [
            Stat::make('Bekleyen Randevular', $pendingCount)
                ->description('Onay bekleyen randevu talepleri')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([7, 3, 4, 5, 6, $pendingCount])
                ->url(AppointmentResource::getUrl()),
        ];
    }
}
