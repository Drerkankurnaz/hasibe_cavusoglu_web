<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Danışan yorumları (testimonial) kayıtlarını seed eder.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'author_name' => 'Ayşe K.',
                'content' => 'Uzun süredir kaygı sorunuyla mücadele ediyordum. Hasibe Hanım\'ın yaklaşımı ve bilişsel davranışçı terapi yöntemiyle çok kısa sürede kendimi daha iyi hissetmeye başladım. Artık kaygımı yönetebiliyorum ve hayatıma daha olumlu bakabiliyorum. Teşekkürler.',
                'rating' => 5,
                'is_approved' => true,
                'order' => 1,
            ],
            [
                'author_name' => 'Mehmet ve Zeynep D.',
                'content' => 'Evliliğimizde ciddi iletişim sorunları yaşıyorduk ve ayrılma noktasına gelmiştik. Çift terapisi sürecinde ilişkimize yeni bir bakış açısı kazandık. Birbirimizi dinlemeyi, anlamayı öğrendik. Şimdi çok daha güçlü bir ilişkimiz var. Hasibe Hanım\'a minnettarız.',
                'rating' => 5,
                'is_approved' => true,
                'order' => 2,
            ],
            [
                'author_name' => 'Elif S.',
                'content' => 'Oğlumun okul uyumu konusunda zorluklar yaşıyorduk. Çocuk terapisi sürecinde hem oğlum hem de biz ebeveynler olarak çok şey öğrendik. Hasibe Hanım\'ın çocuklarla iletişimi gerçekten harika. Oğlum artık okula mutlu gidiyor.',
                'rating' => 5,
                'is_approved' => true,
                'order' => 3,
            ],
            [
                'author_name' => 'Can B.',
                'content' => 'İş hayatındaki stres ve tükenmişlik nedeniyle başvurdum. Online terapi seçeneği sayesinde yoğun programıma rağmen düzenli olarak seanslarıma devam edebildim. Stres yönetimi konusunda çok faydalı araçlar edindim.',
                'rating' => 4,
                'is_approved' => true,
                'order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
