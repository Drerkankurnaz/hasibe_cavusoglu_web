<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * "Hakkımda" sayfası içeriğini seed eder.
     *
     * Not: Eğitim ve sertifikalar listesi şablonda (about.blade.php) timeline
     * olarak sabittir. Burada yalnızca özgeçmiş metni tutulur; bu metin admin
     * panelinden (Sayfalar → Hakkımda) düzenlenebilir.
     */
    public function run(): void
    {
        // Tam genişlikteki "Özgeçmiş" bölümünde gösterilen biyografi metni.
        // (Sol sütundaki kısa tanıtım şablonda sabittir.)
        $body = <<<'HTML'
<p>Klinik Psikolog Hasibe Çavuşoğlu lisans eğitimini Ankara Üniversitesi Psikoloji bölümünde yüksek onur derecesi ile tamamlamıştır. Lisans sürecinde Ankara Üniversitesi Tıp Fakültesi Psikiyatri Anabilim Dalı Ergen Ünitesi'nde ve psikolojik danışmanlık merkezlerinde stajlarını tamamlamıştır. Lisans eğitimini "Yeme Davranışlarının Sosyal Anksiyete ve Ruminatif Düşünme Biçimi ile İlişkisinin İncelenmesi" tezi ile başarıyla tamamlamıştır.</p>

<p>Ardından Klinik Psikoloji yüksek lisans eğitimini tam burslu olarak Antalya Bilim Üniversitesi'nde yüksek onur derecesi ile tamamlamıştır. Yüksek lisans eğitimi kapsamında Kepez Devlet Hastanesi'nde staj yapmıştır. Yüksek lisans süresince Dr. Klinik Psikolog Cumhur Avcil tarafından verilen Bilişsel Davranışçı Terapiler eğitimini tamamlamış ve bu ekolde süpervizyon kapsamında yetişkin danışanların psikoterapi süreçlerini yürütmüştür. "Düşünce – Beden Biçimi Kaynaşması ve Mükemmeliyetçiliğin Yeme Tutumu ile İlişkisinin İncelenmesi" başlıklı yüksek lisans tezini savunarak Uzman Klinik Psikolog unvanını almıştır. Çalışma ve araştırma alanlarını bozulmuş yeme davranışları ve yeme bozuklukları tedavisi üzerinde yoğunlaştırmıştır. Çocuk ve ergenlerle psikoterapi seanslarını Bilişsel Davranışçı Terapi ve EMDR ekolü ile sürdürmekte, zihin kuramı temelli sosyal beceri çalışmaları yapmaktadır.</p>

<p>Şu anda çocuk ve ergenlerle psikoterapi, ruhsal ve gelişimsel değerlendirme, zihin kuramı ve sosyal beceriler üzerinde çalışmalarını sürdürmektedir. Zihin kuramı ve sosyal beceriler sertifikalı uygulayıcısıdır.</p>

<p>Türk Psikologlar Derneği ve EMDR Derneği üyesidir.</p>
HTML;

        Page::updateOrCreate(
            ['slug' => 'hakkimda'],
            [
                'title' => 'Hakkımda',
                'body' => $body,
                'seo_title' => 'Hakkımda | Uzman Klinik Psikolog Hasibe Çavuşoğlu',
                'seo_description' => 'Uzman Klinik Psikolog Hasibe Çavuşoğlu\'nun eğitim geçmişi, aldığı sertifikalar ve çalışma alanları hakkında bilgi.',
            ]
        );
    }
}
