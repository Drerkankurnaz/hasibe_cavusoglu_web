<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Hero arka plan görseli (boşsa blade statik img_box_01.jpg kullanır)
        $this->migrator->add('site.hero_image', null);

        // Numaralı tanıtım kutuları
        $this->migrator->add('site.intro_boxes', [
            [
                'title' => 'Uzman Klinik Psikolog',
                'text' => 'Bireylere, çiftlere ve ailelere yönelik profesyonel psikolojik danışmanlık ve terapi hizmeti sunuyorum.',
            ],
            [
                'title' => 'Kanıta Dayalı Yöntemler',
                'text' => 'Bilişsel davranışçı terapi, şema terapi ve EMDR gibi etkinliği bilimsel olarak desteklenen yaklaşımlarla çalışıyorum.',
            ],
            [
                'title' => 'Güvenli ve Gizli Alan',
                'text' => 'Görüşmeler tamamen gizli, yargısız ve güvenli bir ortamda yürütülür. Kendinizi rahatça ifade edebilirsiniz.',
            ],
        ]);

        // Hakkımda bölümü
        $this->migrator->add('site.about_title', 'Uzman Psikolog Hasibe Çavuşoğlu');
        $this->migrator->add('site.about_text', "On yılı aşkın klinik deneyimimle bireylere, çiftlere ve ailelere bilimsel temelli psikoterapi hizmeti sunuyorum. Bilişsel davranışçı terapi, şema terapi ve EMDR gibi kanıta dayalı yaklaşımlarla; kaygı, depresyon, travma sonrası stres ve ilişki sorunlarında kalıcı çözümler üretmeyi hedefliyorum.\n\nTerapötik süreçte en önemli adım, güvenli ve yargısız bir alan yaratmaktır. Danışanlarımla kurduğum empatik ilişki sayesinde, farkındalık kazanmalarına ve kendi iyileşme güçlerini keşfetmelerine rehberlik ediyorum. Her birey eşsizdir — bu nedenle tedavi planlarımı kişiye özel olarak yapılandırıyorum.");
        // Boşsa blade statik portreyi (about_me_img.jpg) kullanır
        $this->migrator->add('site.about_image', null);

        // Değerler / İlkeler (6 kutu — ikonlar blade'de sıraya göre sabittir)
        $this->migrator->add('site.values', [
            ['title' => 'Gizlilik', 'text' => 'Tüm görüşmeler gizlidir ve paylaştığınız bilgiler korunur. Mahremiyetiniz önceliğimizdir.'],
            ['title' => 'Profesyonellik', 'text' => 'Etik ilkelere bağlı, kanıta dayalı ve profesyonel bir yaklaşımla hizmet veriyorum.'],
            ['title' => 'İçten Destek', 'text' => 'Zorlandığınız her konuda, yargılamadan ve içtenlikle yanınızda olmaya özen gösteriyorum.'],
            ['title' => 'Deneyim', 'text' => 'Yıllara dayanan klinik deneyimle farklı yaş ve ihtiyaçlardaki danışanlarla çalışıyorum.'],
            ['title' => 'Sürekli Gelişim', 'text' => 'Düzenli eğitim ve süpervizyonlarla mesleki bilgimi güncel tutuyorum.'],
            ['title' => 'Güvenilirlik', 'text' => 'Süreç boyunca yanınızdayım. Bir adım atmaya hazır olduğunuzda bana ulaşabilirsiniz.'],
        ]);

        // Neden Beni Seçmelisiniz
        $this->migrator->add('site.why_choose_title', 'Çalışma İlkelerim');
        $this->migrator->add('site.why_choose_text', 'Her danışanın yaşam öyküsünü biricik kabul eden bütüncül bir anlayışla çalışıyorum. Bilimsel temelli yöntemleri; güvene, gizliliğe ve karşılıklı saygıya dayanan bir terapötik ilişkiyle birleştirerek kişiye özel, şeffaf ve sürece saygılı bir destek sunuyorum.');
        $this->migrator->add('site.why_choose_tabs', [
            [
                'title' => 'Avantajlar',
                'content' => "Kanıta dayalı psikoterapilerde eğitim ve deneyimimle, her danışanın ihtiyacına göre esnek ve iş birlikçi bir terapi süreci yürütüyorum.\nÜcretsiz ön görüşme ve değerlendirme\nOnline ve yüz yüze görüşme imkânı\nTamamen gizli ve kişiye özel süreç\nİhtiyaca göre uyarlanmış terapi planı",
            ],
            [
                'title' => 'Süreç',
                'content' => 'İlk görüşmede sizi tanır, ihtiyaçlarınızı birlikte değerlendiririz. Ardından size en uygun yöntemi belirleyip adım adım ilerleyen, şeffaf bir terapi süreci planlarız.',
            ],
            [
                'title' => 'Sonuçlar',
                'content' => 'Hedefimiz; duygusal dayanıklılığınızı artırmak, ilişkilerinizi güçlendirmek ve günlük yaşamınızda kendinizi daha iyi hissetmenizi sağlamaktır. İlerleme süreç içinde birlikte değerlendirilir.',
            ],
        ]);
    }
};
