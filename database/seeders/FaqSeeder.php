<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Sıkça Sorulan Sorular (SSS) kayıtlarını seed eder.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Psikolojik danışmanlık süreci nasıl işler?',
                'answer' => 'İlk görüşmede durumunuz detaylı olarak değerlendirilir ve ihtiyaçlarınıza uygun bir terapi planı oluşturulur. Seanslar genellikle haftada bir kez, 50 dakika sürer. Terapi süreci boyunca gelişiminiz birlikte takip edilir ve gerektiğinde plan güncellenir. Sürecin uzunluğu, ele alınan konunun niteliğine ve kişisel hedeflerinize göre değişir.',
                'category' => 'Genel',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Terapiye ne zaman başvurmalıyım?',
                'answer' => 'Günlük yaşamınızı olumsuz etkileyen duygusal zorluklar, ilişki problemleri, uyku bozuklukları, kaygı veya depresif belirtiler yaşadığınızda profesyonel destek almanız önerilir. Ayrıca kişisel gelişiminizi desteklemek, kendinizi daha iyi tanımak veya yaşam geçişlerinde rehberlik almak için de terapiye başvurabilirsiniz. Sorunların büyümesini beklemeden erken müdahale, tedavi sürecini kısaltır.',
                'category' => 'Genel',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Online terapi yüz yüze terapi kadar etkili mi?',
                'answer' => 'Evet, araştırmalar online terapinin birçok psikolojik sorun için yüz yüze terapiyle karşılaştırılabilir etkinlikte olduğunu göstermektedir. Güvenli video konferans platformları üzerinden gerçekleştirilen seanslar, yüz yüze görüşmenin tüm avantajlarını sunar. Online terapi özellikle coğrafi uzaklık, zaman kısıtlaması veya hareket güçlüğü gibi durumlarda ideal bir alternatiftir.',
                'category' => 'Online Terapi',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Seans ücretleri ve ödeme yöntemleri nelerdir?',
                'answer' => 'Seans ücretleri terapi türüne göre değişmektedir. Bireysel terapi seansları 1.500₺, çift terapisi seansları 2.000₺, aile terapisi seansları 2.500₺ olarak belirlenmiştir. Ödeme nakit, kredi kartı veya havale/EFT ile yapılabilir. İptal durumunda seansın en az 24 saat öncesinde haber verilmesi gerekmektedir.',
                'category' => 'Ücret ve Randevu',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Terapi sürecinde paylaştıklarım gizli tutulur mu?',
                'answer' => 'Evet, terapi sürecinde paylaşılan tüm bilgiler kesinlikle gizlidir. Psikolog-danışan ilişkisi meslek etiği ve yasal düzenlemeler kapsamında gizlilik ilkesine tabidir. Bilgileriniz üçüncü şahıslarla paylaşılmaz. Ancak kişinin kendine veya başkalarına zarar verme riski olduğu durumlarda, yasal bildirim yükümlülüğü kapsamında sınırlı istisnalar mevcuttur.',
                'category' => 'Genel',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Randevumu nasıl iptal edebilir veya değiştirebilirim?',
                'answer' => 'Randevunuzu seansın başlangıcından en az 24 saat önce telefon veya e-posta yoluyla iptal edebilir veya yeni bir tarihe taşıyabilirsiniz. 24 saatten kısa sürede yapılan iptallerde seans ücreti tahsil edilir. Acil durumlar için lütfen doğrudan iletişime geçiniz.',
                'category' => 'Ücret ve Randevu',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
