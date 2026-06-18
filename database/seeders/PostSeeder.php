<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Blog yazıları, kategoriler ve etiketleri seed eder.
     */
    public function run(): void
    {
        // Kategoriler
        $categories = [
            ['name' => 'Psikoloji', 'slug' => 'psikoloji'],
            ['name' => 'Terapi Yöntemleri', 'slug' => 'terapi-yontemleri'],
            ['name' => 'Kişisel Gelişim', 'slug' => 'kisisel-gelisim'],
            ['name' => 'İlişkiler', 'slug' => 'iliskiler'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        // Etiketler
        $tags = [
            ['name' => 'Kaygı', 'slug' => 'kaygi'],
            ['name' => 'Depresyon', 'slug' => 'depresyon'],
            ['name' => 'Stres Yönetimi', 'slug' => 'stres-yonetimi'],
            ['name' => 'Özgüven', 'slug' => 'ozguven'],
            ['name' => 'İlişki', 'slug' => 'iliski'],
            ['name' => 'Travma', 'slug' => 'travma'],
            ['name' => 'Mindfulness', 'slug' => 'mindfulness'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        // Blog yazıları
        $posts = [
            [
                'title' => 'Kaygı Bozukluğu Nedir? Belirtileri ve Tedavi Yöntemleri',
                'slug' => 'kaygi-bozuklugu-nedir-belirtileri-ve-tedavi-yontemleri',
                'category_slug' => 'psikoloji',
                'excerpt' => 'Kaygı bozukluğu, günlük yaşamı olumsuz etkileyen aşırı endişe ve korku durumudur. Bu yazıda kaygı bozukluğunun belirtilerini ve etkili tedavi yöntemlerini ele alıyoruz.',
                'body' => '<h2>Kaygı Bozukluğu Nedir?</h2><p>Kaygı, tehlike veya belirsizlik karşısında hissedilen doğal bir duygudur. Ancak bu duygu günlük yaşamı ciddi şekilde etkilemeye başladığında kaygı bozukluğundan söz edebiliriz. Yaygın kaygı bozukluğu, sosyal kaygı bozukluğu, panik bozukluğu ve spesifik fobiler kaygı bozukluklarının alt türleridir.</p><h2>Belirtileri</h2><p>Kaygı bozukluğunun fiziksel ve psikolojik belirtileri vardır:</p><ul><li>Sürekli endişe ve huzursuzluk hissi</li><li>Uyku bozuklukları</li><li>Kas gerginliği ve baş ağrısı</li><li>Kalp çarpıntısı ve nefes darlığı</li><li>Konsantrasyon güçlüğü</li><li>Sinirlilik ve huzursuzluk</li></ul><h2>Tedavi Yöntemleri</h2><p>Kaygı bozukluğunun tedavisinde bilişsel davranışçı terapi (BDT) en yaygın ve etkili yöntemlerden biridir. BDT, kişinin olumsuz düşünce kalıplarını fark etmesini ve bunları daha işlevsel düşüncelerle değiştirmesini sağlar.</p><p>Bunun yanı sıra nefes egzersizleri, gevşeme teknikleri, mindfulness uygulamaları ve düzenli fiziksel aktivite kaygının yönetiminde destekleyici rol oynar.</p><p>Profesyonel destek almak, kaygı bozukluğunun tedavisinde en önemli adımdır. Uzman bir psikolog eşliğinde kişiye özel terapi planı oluşturularak kaygı belirtileri kontrol altına alınabilir.</p>',
                'cover_image' => null,
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(7),
                'reading_time' => 5,
                'views' => 124,
                'seo_title' => 'Kaygı Bozukluğu Nedir? Belirtileri ve Tedavi Yöntemleri',
                'seo_description' => 'Kaygı bozukluğunun belirtileri, nedenleri ve tedavi yöntemleri hakkında kapsamlı bilgi. Uzman psikolog eşliğinde etkili terapi.',
                'tags' => ['kaygi', 'stres-yonetimi'],
            ],
            [
                'title' => 'Sağlıklı İlişki Kurmanın 7 Altın Kuralı',
                'slug' => 'saglikli-iliski-kurmanin-7-altin-kurali',
                'category_slug' => 'iliskiler',
                'excerpt' => 'Sağlıklı ve mutlu bir ilişki kurmak emek ve farkındalık gerektirir. İletişim, güven ve empati temelli ilişki kurma stratejilerini keşfedin.',
                'body' => '<h2>Sağlıklı İlişkinin Temelleri</h2><p>Her ilişki benzersizdir, ancak sağlıklı ilişkilerin ortak bazı özellikleri vardır. İşte ilişkinizi güçlendirecek 7 temel kural:</p><h3>1. Açık ve Dürüst İletişim</h3><p>İletişim, her ilişkinin temel taşıdır. Duygularınızı, ihtiyaçlarınızı ve sınırlarınızı açıkça ifade etmek ilişkinizi güçlendirir. "Ben" dili kullanarak hislerinizi paylaşmak, suçlayıcı olmadan iletişim kurmanızı sağlar.</p><h3>2. Aktif Dinleme</h3><p>Partnerinizi gerçekten dinlemek, sadece konuşmasını beklemekten farklıdır. Empati kurarak, yargılamadan ve tam dikkatle dinlemek, karşınızdakine değer verdiğinizi gösterir.</p><h3>3. Güven İnşa Etme</h3><p>Güven, tutarlı davranışlarla zaman içinde inşa edilir. Sözlerinizi tutmak, şeffaf olmak ve partnerinize saygı göstermek güvenin temelini oluşturur.</p><h3>4. Bireysel Alanı Koruma</h3><p>Sağlıklı bir ilişkide her iki partnerin de kendi bireysel alanı, hobileri ve sosyal çevresi olmalıdır. Bağımsızlık, ilişkiyi besler.</p><h3>5. Çatışma Yönetimi</h3><p>Her ilişkide çatışmalar yaşanır. Önemli olan, çatışmaları yapıcı bir şekilde çözmektir. Saygılı bir şekilde tartışmak ve uzlaşma aramak anahtardır.</p><h3>6. Takdir ve Minnettarlık</h3><p>Partnerinize düzenli olarak takdir ve minnettarlık ifade etmek, ilişkinin olumlu atmosferini korur.</p><h3>7. Birlikte Büyüme</h3><p>Sağlıklı ilişkiler, her iki partnerin de bireysel ve birlikte büyüdüğü dinamik süreçlerdir. Ortak hedefler belirlemek ve birbirinizi desteklemek ilişkinizi güçlendirir.</p>',
                'cover_image' => null,
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(14),
                'reading_time' => 7,
                'views' => 89,
                'seo_title' => 'Sağlıklı İlişki Kurmanın 7 Altın Kuralı | Çift Terapisi',
                'seo_description' => 'Sağlıklı ilişki kurma ipuçları. İletişim, güven ve empati temelli ilişki stratejileri. Uzman psikolog önerileri.',
                'tags' => ['iliski', 'ozguven'],
            ],
            [
                'title' => 'Stres Yönetimi: Günlük Hayatta Uygulanabilir Teknikler',
                'slug' => 'stres-yonetimi-gunluk-hayatta-uygulanabilir-teknikler',
                'category_slug' => 'kisisel-gelisim',
                'excerpt' => 'Modern yaşamın getirdiği stresle başa çıkmanın etkili yollarını öğrenin. Günlük hayatınıza kolayca entegre edebileceğiniz stres yönetimi teknikleri.',
                'body' => '<h2>Stresin Yaşamımızdaki Yeri</h2><p>Stres, modern yaşamın kaçınılmaz bir parçasıdır. İş baskısı, ekonomik kaygılar, ilişki sorunları ve sağlık endişeleri stresin yaygın kaynaklarıdır. Ancak kronik stres, hem fiziksel hem de psikolojik sağlığımızı ciddi şekilde olumsuz etkileyebilir.</p><h2>Etkili Stres Yönetimi Teknikleri</h2><h3>Mindfulness (Farkındalık) Meditasyonu</h3><p>Günde 10-15 dakikalık mindfulness meditasyonu, stresin etkilerini azaltmada bilimsel olarak kanıtlanmış bir yöntemdir. Nefes odaklı farkındalık, şimdiki ana dikkat kesilmenizi ve düşüncelerinizi yargılamadan gözlemlemenizi sağlar.</p><h3>Nefes Egzersizleri</h3><p>4-7-8 nefes tekniği (4 saniye nefes alın, 7 saniye tutun, 8 saniye verin) parasempatik sinir sistemini aktive eder ve anında sakinleşme sağlar.</p><h3>Fiziksel Aktivite</h3><p>Düzenli egzersiz, vücuttaki stres hormonlarını azaltır ve endorfin salgılanmasını artırır. Haftada en az 150 dakika orta şiddette egzersiz önerilir.</p><h3>Uyku Hijyeni</h3><p>Kaliteli uyku, stresle başa çıkabilmemiz için kritik öneme sahiptir. Düzenli uyku saatleri, karanlık ve sessiz bir uyku ortamı, uyumadan önce ekran kullanımından kaçınma önemli adımlardır.</p><h3>Sosyal Bağlantılar</h3><p>Güvendiğiniz insanlarla vakit geçirmek ve duygularınızı paylaşmak, stresin yükünü hafifletir. Sosyal destek ağı, psikolojik dayanıklılığın önemli bir bileşenidir.</p><h2>Ne Zaman Profesyonel Destek Almalısınız?</h2><p>Stres belirtileri günlük yaşamınızı ciddi şekilde etkiliyorsa, uyku ve beslenme düzeniniz bozulduysa veya kendi başınıza başa çıkmakta zorlanıyorsanız, profesyonel psikolojik destek almanız önerilir.</p>',
                'cover_image' => null,
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(21),
                'reading_time' => 6,
                'views' => 156,
                'seo_title' => 'Stres Yönetimi Teknikleri | Günlük Hayatta Uygulama',
                'seo_description' => 'Etkili stres yönetimi teknikleri. Mindfulness, nefes egzersizleri ve günlük uygulanabilir yöntemler.',
                'tags' => ['stres-yonetimi', 'mindfulness'],
            ],
        ];

        foreach ($posts as $postData) {
            $categorySlug = $postData['category_slug'];
            $tagSlugs = $postData['tags'];
            unset($postData['category_slug'], $postData['tags']);

            $category = Category::where('slug', $categorySlug)->first();
            $postData['category_id'] = $category?->id;

            $post = Post::create($postData);

            $tagIds = Tag::whereIn('slug', $tagSlugs)->pluck('id');
            $post->tags()->sync($tagIds);
        }
    }
}
