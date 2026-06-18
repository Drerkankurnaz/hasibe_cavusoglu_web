<?php

namespace App\Filament\Resources;

use App\Enums\AppointmentStatus;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Mail\AppointmentCancelledMailable;
use App\Mail\AppointmentConfirmedMailable;
use App\Models\Appointment;
use App\Models\Service;
use App\Services\MailService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static string|\UnitEnum|null $navigationGroup = 'Yönetim';

    protected static ?string $modelLabel = 'Randevu';

    protected static ?string $pluralModelLabel = 'Randevular';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Randevu Bilgileri')
                    ->schema([
                        TextInput::make('name')
                            ->label('Ad Soyad')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('E-posta')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Telefon')
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        Select::make('service_id')
                            ->label('Hizmet')
                            ->options(Service::active()->pluck('title', 'id'))
                            ->searchable()
                            ->nullable(),

                        DateTimePicker::make('preferred_at')
                            ->label('Tercih Edilen Tarih/Saat')
                            ->required()
                            ->native(false)
                            ->displayFormat('d.m.Y H:i'),

                        Select::make('status')
                            ->label('Durum')
                            ->options([
                                AppointmentStatus::Pending->value => 'Beklemede',
                                AppointmentStatus::Confirmed->value => 'Onaylandı',
                                AppointmentStatus::Cancelled->value => 'İptal Edildi',
                                AppointmentStatus::Completed->value => 'Tamamlandı',
                            ])
                            ->required()
                            ->default(AppointmentStatus::Pending->value),

                        Textarea::make('notes')
                            ->label('Notlar')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('service.title')
                    ->label('Hizmet')
                    ->sortable()
                    ->placeholder('Belirtilmedi'),

                Tables\Columns\TextColumn::make('preferred_at')
                    ->label('Tercih Edilen Tarih')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        AppointmentStatus::Pending->value => 'warning',
                        AppointmentStatus::Confirmed->value => 'success',
                        AppointmentStatus::Cancelled->value => 'danger',
                        AppointmentStatus::Completed->value => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        AppointmentStatus::Pending->value => 'Beklemede',
                        AppointmentStatus::Confirmed->value => 'Onaylandı',
                        AppointmentStatus::Cancelled->value => 'İptal Edildi',
                        AppointmentStatus::Completed->value => 'Tamamlandı',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        AppointmentStatus::Pending->value => 'Beklemede',
                        AppointmentStatus::Confirmed->value => 'Onaylandı',
                        AppointmentStatus::Cancelled->value => 'İptal Edildi',
                        AppointmentStatus::Completed->value => 'Tamamlandı',
                    ]),

                Tables\Filters\SelectFilter::make('service_id')
                    ->label('Hizmet')
                    ->options(Service::pluck('title', 'id')),
            ])
            ->actions([
                Tables\Actions\Action::make('confirm')
                    ->label('Onayla')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Randevuyu Onayla')
                    ->modalDescription('Bu randevuyu onaylamak istediğinize emin misiniz? Müşteriye onay e-postası gönderilecektir.')
                    ->modalSubmitActionLabel('Evet, Onayla')
                    ->visible(fn (Appointment $record): bool => $record->status === AppointmentStatus::Pending)
                    ->action(function (Appointment $record): void {
                        $record->update(['status' => AppointmentStatus::Confirmed->value]);

                        $mailService = app(MailService::class);
                        $mailService->safeSend(
                            $record->email,
                            new AppointmentConfirmedMailable($record)
                        );
                    }),

                Tables\Actions\Action::make('cancel')
                    ->label('İptal Et')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Randevuyu İptal Et')
                    ->modalDescription('Bu randevuyu iptal etmek istediğinize emin misiniz? Müşteriye iptal e-postası gönderilecektir.')
                    ->modalSubmitActionLabel('Evet, İptal Et')
                    ->visible(fn (Appointment $record): bool => in_array($record->status, [AppointmentStatus::Pending, AppointmentStatus::Confirmed]))
                    ->action(function (Appointment $record): void {
                        $record->update(['status' => AppointmentStatus::Cancelled->value]);

                        $mailService = app(MailService::class);
                        $mailService->safeSend(
                            $record->email,
                            new AppointmentCancelledMailable($record)
                        );
                    }),

                Tables\Actions\Action::make('complete')
                    ->label('Tamamla')
                    ->icon('heroicon-o-check-badge')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->modalHeading('Randevuyu Tamamla')
                    ->modalDescription('Bu randevuyu tamamlandı olarak işaretlemek istediğinize emin misiniz?')
                    ->modalSubmitActionLabel('Evet, Tamamla')
                    ->visible(fn (Appointment $record): bool => $record->status === AppointmentStatus::Confirmed)
                    ->action(function (Appointment $record): void {
                        $record->update(['status' => AppointmentStatus::Completed->value]);
                    }),

                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', AppointmentStatus::Pending->value)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
