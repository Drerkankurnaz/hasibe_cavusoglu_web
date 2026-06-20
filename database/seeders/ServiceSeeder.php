<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Psikoloji hizmetlerini seed eder.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Bireysel Terapi',
                'slug' => 'bireysel-terapi',
                'short_description' => 'Bireysel terapi, kişisel sorunlarınızı güvenli bir ortamda ele almanızı sağlar. Kaygı, depresyon, stres ve yaşam zorlukları ile başa çıkmanızda profesyonel destek sunar.',
                'description' => '<p>Bireysel terapi, danışanın terapistle birebir çalıştığı bir psikoterapi sürecidir. Bu süreçte; kaygı bozuklukları, depresyon, stres yönetimi, özgüven eksikliği, travma sonrası stres bozukluğu, yas ve kayıp, ilişki sorunları gibi konularda profesyonel destek sağlanır.</p><p>Terapi sürecinde bilişsel davranışçı terapi (BDT), şema terapi ve EMDR gibi kanıta dayalı yöntemler kullanılarak danışanın ruhsal iyilik halini artırmak hedeflenir.</p><p>Seanslar genellikle haftada bir kez, 50 dakika sürmektedir. Terapi sürecinin uzunluğu, danışanın ihtiyaçlarına ve tedavi hedeflerine göre birlikte belirlenir.</p>',
                'icon' => 'bireysel.jpg',
                'image' => null,
                'price' => 1500.00,
                'duration' => '50 dakika',
                'order' => 1,
                'is_active' => true,
                'seo_title' => 'Bireysel Terapi | Psikolog Hasibe Çavuşoğlu',
                'seo_description' => 'Bireysel terapi ile kaygı, depresyon ve stres sorunlarınıza profesyonel çözüm. Uzman psikolog eşliğinde güvenli terapi ortamı.',
            ],
            [
                'title' => 'Çift Terapisi',
                'slug' => 'cift-terapisi',
                'short_description' => 'Çift terapisi, ilişkinizde yaşadığınız iletişim sorunları, güven problemleri ve çatışmaları çözmenize yardımcı olur. Birlikte daha sağlıklı bir ilişki kurmanızı destekler.',
                'description' => '<p>Çift terapisi, ilişkilerinde zorluk yaşayan çiftlere yönelik profesyonel bir destek sürecidir. İletişim bozuklukları, güven sorunları, aldatma sonrası süreç, cinsel uyumsuzluk, boşanma sürecinde destek ve ebeveynlik konularında çiftlere yardımcı olur.</p><p>Terapi sürecinde Gottman Çift Terapisi ve Duygu Odaklı Çift Terapisi (EFT) gibi etkinliği kanıtlanmış yöntemler kullanılır. Amaç, çiftlerin birbirlerini daha iyi anlamalarını, sağlıklı iletişim kurabilmelerini ve ilişkilerini güçlendirmelerini sağlamaktır.</p><p>Seanslar her iki partnerin katılımıyla, 75-90 dakika sürmektedir.</p>',
                'icon' => 'cift.jpg',
                'image' => null,
                'price' => 2000.00,
                'duration' => '75 dakika',
                'order' => 2,
                'is_active' => true,
                'seo_title' => 'Çift Terapisi | Psikolog Hasibe Çavuşoğlu',
                'seo_description' => 'Çift terapisi ile ilişkinizi güçlendirin. İletişim sorunları, güven problemleri için uzman psikolog desteği.',
            ],
            [
                'title' => 'Aile Terapisi',
                'slug' => 'aile-terapisi',
                'short_description' => 'Aile terapisi, aile içi iletişim sorunlarını, nesiller arası çatışmaları ve rol belirsizliklerini ele alarak aile üyelerinin uyumunu artırır.',
                'description' => '<p>Aile terapisi, aile sistemindeki ilişki kalıplarını ve iletişim problemlerini ele alan bir psikoterapi yaklaşımıdır. Aile içi çatışmalar, ergen-ebeveyn sorunları, boşanma sürecinde çocuklara destek, kayıp ve yas sürecinde aile desteği gibi konularda çalışılır.</p><p>Sistemik aile terapisi yaklaşımı temelinde, aile üyelerinin birbirlerini daha iyi anlamaları, sağlıklı sınırlar koyabilmeleri ve aile dinamiklerini olumlu yönde dönüştürmeleri hedeflenir.</p><p>Seanslar aile üyelerinin katılımıyla, 90 dakika sürmektedir. Gerektiğinde bireysel görüşmeler de planlanabilir.</p>',
                'icon' => 'aile.jpg',
                'image' => null,
                'price' => 2500.00,
                'duration' => '90 dakika',
                'order' => 3,
                'is_active' => true,
                'seo_title' => 'Aile Terapisi | Psikolog Hasibe Çavuşoğlu',
                'seo_description' => 'Aile terapisi ile aile içi iletişim sorunlarını çözün. Profesyonel aile danışmanlığı hizmeti.',
            ],
            [
                'title' => 'Çocuk ve Ergen Terapisi',
                'slug' => 'cocuk-ve-ergen-terapisi',
                'short_description' => 'Çocuk ve ergenlerin gelişim dönemlerine uygun terapi yaklaşımlarıyla davranış sorunları, okul uyumu ve duygusal zorluklar konusunda destek sağlar.',
                'description' => '<p>Çocuk ve ergen terapisi, 5-18 yaş grubundaki bireylerin gelişimsel, duygusal ve davranışsal sorunlarına yönelik profesyonel destek sunar. Dikkat eksikliği, hiperaktivite, okul uyumu, akran zorbalığı, kaygı bozuklukları, depresyon, öfke kontrolü ve travma gibi konularda çalışılır.</p><p>Çocuklarla çalışırken oyun terapisi, sanat terapisi ve bilişsel davranışçı terapi teknikleri yaşa uygun şekilde kullanılır. Ergenlerle ise kimlik arayışı, bağımsızlaşma, akademik stres ve sosyal ilişki sorunları gibi dönemsel konular ele alınır.</p><p>Çocuk terapisi seansları 45 dakika, ergen terapisi seansları 50 dakika sürmektedir. Süreçte ebeveyn görüşmeleri de düzenli olarak planlanır.</p>',
                'icon' => 'cocuk.jpg',
                'image' => null,
                'price' => 1500.00,
                'duration' => '45-50 dakika',
                'order' => 4,
                'is_active' => true,
                'seo_title' => 'Çocuk ve Ergen Terapisi | Psikolog Hasibe Çavuşoğlu',
                'seo_description' => 'Çocuk ve ergen terapisi ile çocuğunuzun duygusal gelişimini destekleyin. Oyun terapisi ve BDT yöntemleri.',
            ],
            [
                'title' => 'Online Terapi',
                'slug' => 'online-terapi',
                'short_description' => 'Online terapi ile bulunduğunuz yerden bağımsız olarak profesyonel psikolojik destek alabilirsiniz. Güvenli video görüşme ile yüz yüze terapi deneyimi.',
                'description' => '<p>Online terapi, coğrafi uzaklık, zaman kısıtlaması veya fiziksel engeller nedeniyle yüz yüze terapiye erişemeyen danışanlara güvenli bir şekilde psikolojik destek sunmaktadır.</p><p>Güvenli ve şifreli video konferans platformları üzerinden gerçekleştirilen online seanslar, yüz yüze terapi ile aynı etkinlikte sonuçlar vermektedir. Bireysel terapi, çift terapisi ve ergen terapisi online olarak da sürdürülebilir.</p><p>Online terapi için sessiz, özel bir alan ve stabil bir internet bağlantısı yeterlidir. Seanslar yüz yüze terapiyle aynı süre ve ücretlendirme ile gerçekleştirilir.</p>',
                'icon' => 'online.jpg',
                'image' => null,
                'price' => 1500.00,
                'duration' => '50 dakika',
                'order' => 5,
                'is_active' => true,
                'seo_title' => 'Online Terapi | Psikolog Hasibe Çavuşoğlu',
                'seo_description' => 'Online psikolojik danışmanlık ile her yerden terapi desteği alın. Güvenli video görüşme ile uzman psikolog.',
            ],
            [
                'title' => 'EMDR Terapisi',
                'slug' => 'emdr-terapisi',
                'short_description' => 'EMDR, travmatik anıların işlenmesini sağlayan kanıta dayalı bir psikoterapi yöntemidir. Travma sonrası stres bozukluğu tedavisinde etkili sonuçlar verir.',
                'description' => '<p>EMDR (Göz Hareketleriyle Duyarsızlaştırma ve Yeniden İşleme), travmatik yaşantıların ve olumsuz anıların işlenmesini sağlayan, Dünya Sağlık Örgütü (WHO) tarafından travma tedavisinde önerilen bir psikoterapi yöntemidir.</p><p>Travma sonrası stres bozukluğu (TSSB), panik bozukluğu, fobiler, yas ve kayıp, çocukluk çağı travmaları, performans kaygısı gibi durumların tedavisinde kullanılır.</p><p>EMDR terapisi, göz hareketleri veya diğer bilateral (iki taraflı) uyarım teknikleri kullanarak beynin doğal iyileşme mekanizmasını harekete geçirir. Standart terapi sürecine göre daha kısa sürede etkili sonuçlar alınabilir.</p><p>Seanslar 60-90 dakika sürmekte olup, tedavi süresi travmanın niteliğine göre değişir.</p>',
                'icon' => 'emdr.jpg',
                'image' => null,
                'price' => 2000.00,
                'duration' => '60-90 dakika',
                'order' => 6,
                'is_active' => true,
                'seo_title' => 'EMDR Terapisi | Psikolog Hasibe Çavuşoğlu',
                'seo_description' => 'EMDR terapisi ile travmatik anılarınızı işleyin. Kanıta dayalı travma tedavisi için uzman psikolog desteği.',
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
