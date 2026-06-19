<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                                        FileUpload::make('hero_image')
                                            ->label('Hero Arka Plan Görseli')
                                            ->image()
                                            ->disk('public')
                                            ->directory('site')
                                            ->nullable()
                                            ->helperText('Boş bırakılırsa varsayılan görsel kullanılır. Önerilen: geniş yatay görsel (örn. 1920×657).')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Footer')
                                    ->schema([
                                        TextInput::make('footer_text')
                                            ->label('Footer Metni')
                                            ->required()
                                            ->maxLength(500),
                                    ]),
                            ]),

                        Tab::make('Anasayfa')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('Tanıtım Kutuları (01 / 02 / 03)')
                                    ->description('Hero altındaki numaralı üç kutu.')
                                    ->schema([
                                        Repeater::make('intro_boxes')
                                            ->label('Tanıtım Kutuları')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Başlık')
                                                    ->required(),
                                                Textarea::make('text')
                                                    ->label('Açıklama')
                                                    ->required()
                                                    ->rows(2),
                                            ])
                                            ->maxItems(3)
                                            ->reorderable()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                    ]),

                                Section::make('Hakkımda Bölümü')
                                    ->schema([
                                        TextInput::make('about_title')
                                            ->label('Başlık')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('about_text')
                                            ->label('Metin')
                                            ->helperText('Paragrafları boş satırla ayırabilirsiniz.')
                                            ->required()
                                            ->rows(7)
                                            ->columnSpanFull(),
                                        FileUpload::make('about_image')
                                            ->label('Yan Görsel (Portre)')
                                            ->image()
                                            ->disk('public')
                                            ->directory('site')
                                            ->nullable()
                                            ->helperText('Boş bırakılırsa varsayılan portre kullanılır.')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Değerler / İlkeler')
                                    ->description('Altı kutu. İkonlar sırayla sabittir; başlık ve metni düzenleyebilirsiniz.')
                                    ->schema([
                                        Repeater::make('values')
                                            ->label('Değerler')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Başlık')
                                                    ->required(),
                                                Textarea::make('text')
                                                    ->label('Açıklama')
                                                    ->required()
                                                    ->rows(2),
                                            ])
                                            ->maxItems(6)
                                            ->reorderable()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                    ]),

                                Section::make('Neden Beni Seçmelisiniz')
                                    ->schema([
                                        TextInput::make('why_choose_title')
                                            ->label('Başlık')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('why_choose_text')
                                            ->label('Giriş Metni')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                        Repeater::make('why_choose_tabs')
                                            ->label('Sekmeler')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Sekme Başlığı')
                                                    ->required(),
                                                Textarea::make('content')
                                                    ->label('İçerik')
                                                    ->helperText('Her satır ayrı bir madde olarak gösterilebilir.')
                                                    ->required()
                                                    ->rows(4),
                                            ])
                                            ->maxItems(5)
                                            ->reorderable()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->columnSpanFull(),
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

                        Tab::make('Bakım Modu')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->schema([
                                Section::make('Bakım Modu Ayarları')
                                    ->description('Bakım modunu açtığınızda ziyaretçiler bakım sayfasını görür. Admin paneline erişim etkilenmez.')
                                    ->schema([
                                        Toggle::make('maintenance_mode')
                                            ->label('Bakım Modu')
                                            ->helperText('Aktif edildiğinde site ziyaretçilere bakım sayfası gösterir.')
                                            ->onColor('danger')
                                            ->offColor('success')
                                            ->onIcon('heroicon-m-wrench')
                                            ->offIcon('heroicon-m-check')
                                            ->live()
                                            ->columnSpanFull(),
                                        TextInput::make('maintenance_title')
                                            ->label('Bakım Sayfası Başlığı')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Site Bakımda'),
                                        Textarea::make('maintenance_message')
                                            ->label('Bakım Mesajı')
                                            ->required()
                                            ->rows(4)
                                            ->maxLength(1000)
                                            ->helperText('Ziyaretçilere gösterilecek mesaj')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
