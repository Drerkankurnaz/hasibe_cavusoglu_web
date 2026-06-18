<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ManageSiteSettings extends SettingsPage
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SiteSettings::class;

    protected static ?string $navigationLabel = 'Site Ayarları';

    protected static ?string $title = 'Site Ayarları';

    protected static string | \UnitEnum | null $navigationGroup = 'Ayarlar';

    protected static ?int $navigationSort = 100;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Ayarlar')
                    ->tabs([
                        Tab::make('Genel')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Section::make('Logo & Favicon')
                                    ->schema([
                                        FileUpload::make('logo')
                                            ->label('Site Logosu')
                                            ->image()
                                            ->disk('public')
                                            ->directory('site')
                                            ->nullable()
                                            ->columnSpanFull(),
                                        FileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->image()
                                            ->disk('public')
                                            ->directory('site')
                                            ->nullable(),
                                    ])
                                    ->columns(2),

                                Section::make('Hero Alanı')
                                    ->schema([
                                        TextInput::make('hero_title')
                                            ->label('Hero Başlık')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('hero_subtitle')
                                            ->label('Hero Alt Başlık')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('hero_cta_text')
                                            ->label('Hero Buton Metni')
                                            ->required()
                                            ->maxLength(100),
                                    ]),

                                Section::make('Footer')
                                    ->schema([
                                        TextInput::make('footer_text')
                                            ->label('Footer Metni')
                                            ->required()
                                            ->maxLength(500),
                                    ]),
                            ]),

                        Tab::make('İletişim')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Section::make('İletişim Bilgileri')
                                    ->schema([
                                        TextInput::make('phone')
                                            ->label('Telefon')
                                            ->required()
                                            ->tel()
                                            ->maxLength(20),
                                        TextInput::make('whatsapp')
                                            ->label('WhatsApp')
                                            ->tel()
                                            ->nullable()
                                            ->maxLength(20),
                                        TextInput::make('email')
                                            ->label('E-posta')
                                            ->required()
                                            ->email()
                                            ->maxLength(255),
                                        Textarea::make('address')
                                            ->label('Adres')
                                            ->required()
                                            ->rows(3)
                                            ->maxLength(500),
                                    ])
                                    ->columns(2),

                                Section::make('Harita')
                                    ->schema([
                                        Textarea::make('map_embed')
                                            ->label('Google Maps Embed Kodu')
                                            ->helperText('Google Maps\'ten alınan iframe kodunu yapıştırın')
                                            ->nullable()
                                            ->rows(4)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Tab::make('Çalışma Saatleri')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Repeater::make('working_hours')
                                    ->label('Çalışma Saatleri')
                                    ->schema([
                                        TextInput::make('label')
                                            ->label('Gün / Dönem')
                                            ->required()
                                            ->placeholder('Örn: Pazartesi - Cuma'),
                                        TextInput::make('value')
                                            ->label('Saat Aralığı')
                                            ->required()
                                            ->placeholder('Örn: 09:00 - 18:00'),
                                    ])
                                    ->columns(2)
                                    ->defaultItems(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                            ]),

                        Tab::make('Sosyal Medya')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Repeater::make('social_links')
                                    ->label('Sosyal Medya Bağlantıları')
                                    ->schema([
                                        TextInput::make('platform')
                                            ->label('Platform')
                                            ->required()
                                            ->placeholder('Örn: Facebook, Instagram, Twitter'),
                                        TextInput::make('url')
                                            ->label('URL')
                                            ->required()
                                            ->url()
                                            ->placeholder('https://...'),
                                        TextInput::make('icon')
                                            ->label('İkon Sınıfı')
                                            ->required()
                                            ->placeholder('Örn: fa fa-facebook')
                                            ->helperText('Font Awesome ikon sınıfı'),
                                    ])
                                    ->columns(3)
                                    ->defaultItems(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['platform'] ?? null),
                            ]),

                        Tab::make('SEO & Analitik')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Section::make('SEO')
                                    ->schema([
                                        Textarea::make('default_meta_description')
                                            ->label('Varsayılan Meta Açıklama')
                                            ->helperText('Sayfalarda özel açıklama yoksa bu kullanılır')
                                            ->nullable()
                                            ->rows(3)
                                            ->maxLength(320),
                                    ]),

                                Section::make('Google Analytics')
                                    ->schema([
                                        TextInput::make('ga_id')
                                            ->label('Google Analytics ID')
                                            ->nullable()
                                            ->placeholder('G-XXXXXXXXXX')
                                            ->maxLength(20),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
