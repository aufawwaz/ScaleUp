<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::insert([
            [
                'title' => 'Kebangkitan UMKM di Era Digital', 
                'description' => 'Transformasi digital membawa angin segar bagi UMKM di Indonesia',
                'image' => '/storage/news/umkm_digital.jpg',
                'view' => rand(1, 2500),
                'date' => '2025-06-04', 
                'content' => "Di tengah pesatnya perkembangan teknologi, usaha mikro, kecil, dan menengah (UMKM) mulai menunjukkan taringnya dalam ekosistem digital. Pemanfaatan platform online seperti marketplace, media sosial, hingga aplikasi kasir digital memberikan ruang baru bagi UMKM untuk tumbuh dan bersaing di pasar yang lebih luas.\n
                    \n
                    Pemerintah Indonesia pun terus mendorong transformasi ini melalui berbagai program pelatihan dan bantuan modal berbasis teknologi. Tujuannya adalah untuk meningkatkan literasi digital pelaku UMKM agar mampu memanfaatkan teknologi dengan maksimal dalam menjalankan usahanya.\n
                    \n
                    Tidak hanya itu, pandemi COVID-19 yang lalu juga menjadi pemicu utama UMKM untuk beradaptasi lebih cepat dengan sistem digital. Banyak pelaku usaha yang sebelumnya hanya mengandalkan toko fisik, kini berhasil mengembangkan usaha mereka secara daring dengan hasil yang lebih menjanjikan.\n
                    \n
                    Dengan dukungan infrastruktur digital yang terus berkembang dan peningkatan kualitas sumber daya manusia, UMKM di Indonesia memiliki potensi besar menjadi tulang punggung ekonomi nasional di era digital yang semakin kompetitif ini."
            ],
            [
                'title' => 'Strategi Bisnis Berkelanjutan di Tengah Tantangan Global', 
                'description' => 'Perusahaan dituntut untuk beradaptasi dengan prinsip keberlanjutan demi daya saing jangka panjang.',
                'image' => '/storage/news/strategi_bisnis_global.png',
                'view' => rand(1, 2500),
                'date' => '2025-05-29', 
                'content' => "Dalam menghadapi tantangan global seperti perubahan iklim, krisis energi, dan fluktuasi ekonomi, perusahaan dituntut untuk menerapkan strategi bisnis yang berkelanjutan. Konsep sustainability kini tidak lagi menjadi pilihan, melainkan keharusan bagi pelaku usaha yang ingin bertahan dalam jangka panjang.\n
                    \n
                    Prinsip bisnis berkelanjutan mencakup efisiensi penggunaan sumber daya, pengurangan limbah, dan penerapan praktik ramah lingkungan dalam setiap aspek operasional. Tidak hanya itu, aspek sosial seperti kesejahteraan karyawan, keterlibatan komunitas, dan transparansi bisnis juga menjadi indikator penting dalam menilai keberhasilan suatu perusahaan.\n
                    \n
                    Banyak perusahaan besar di dunia telah berinvestasi pada energi terbarukan, teknologi hijau, dan sistem produksi rendah emisi. Mereka menyadari bahwa keberlanjutan bukan hanya tanggung jawab sosial, tetapi juga kunci daya saing dalam pasar global yang semakin sadar lingkungan.\n
                    \n
                    Ke depan, pelaku usaha yang mampu menyeimbangkan antara keuntungan ekonomi dan dampak sosial-lingkungan akan menjadi pionir dalam industri mereka. Strategi berkelanjutan bukan hanya menciptakan citra positif, tetapi juga membuka peluang inovasi dan pertumbuhan jangka panjang."
            ],
            [
                'title' => 'Digitalisasi Bisnis sebagai Kunci Pertumbuhan Ekonomi Nasional', 
                'description' => 'Transformasi digital menjadi faktor utama dalam percepatan pertumbuhan bisnis di Indonesia.',
                'image' => '/storage/news/digitalisasi_bisnis.webp',
                'view' => rand(1, 2500),
                'date' => '2025-05-29', 
                'content' => "Perkembangan teknologi digital telah membawa perubahan besar dalam lanskap bisnis global, termasuk di Indonesia. Digitalisasi bukan lagi sebuah pilihan, melainkan kebutuhan yang harus diadopsi oleh seluruh pelaku usaha, baik skala besar maupun kecil, untuk bertahan dan berkembang di tengah kompetisi yang semakin ketat.\n
                    \n
                    Transformasi digital tidak hanya mencakup kehadiran bisnis di dunia maya, tetapi juga integrasi teknologi dalam proses produksi, distribusi, hingga pelayanan konsumen. Dengan sistem berbasis digital, perusahaan dapat meningkatkan efisiensi operasional, menekan biaya produksi, serta memperluas jangkauan pasar tanpa batasan geografis.\n
                    \n
                    Salah satu sektor yang merasakan manfaat besar dari digitalisasi adalah sektor ritel. Melalui platform e-commerce, banyak pelaku usaha dapat menjual produk mereka secara langsung kepada konsumen tanpa harus membuka toko fisik. Hal ini tidak hanya mengurangi beban biaya, tetapi juga memberikan fleksibilitas dalam mengatur strategi pemasaran dan penjualan.\n
                    \n
                    Di sisi lain, adopsi teknologi juga memungkinkan pengumpulan data konsumen secara real-time yang bisa dimanfaatkan untuk merancang produk dan layanan yang lebih tepat sasaran. Kecerdasan buatan (AI), analisis data, dan otomatisasi proses bisnis kini menjadi alat penting untuk meningkatkan kualitas layanan dan pengalaman pelanggan.\n
                    \n
                    Namun, proses digitalisasi juga membawa tantangan tersendiri, terutama bagi usaha kecil dan menengah yang masih memiliki keterbatasan dalam hal infrastruktur dan sumber daya manusia. Oleh karena itu, dukungan dari pemerintah, sektor swasta, dan institusi pendidikan sangat dibutuhkan untuk membangun ekosistem digital yang inklusif dan berkelanjutan.\n
                    \n
                    Pemerintah Indonesia sendiri telah meluncurkan berbagai inisiatif seperti program literasi digital, pelatihan teknologi, serta kemudahan perizinan bagi startup dan UMKM digital. Kebijakan ini diharapkan mampu mendorong lebih banyak pelaku usaha untuk berani bertransformasi dan ikut serta dalam perekonomian digital nasional.\n
                    \n
                    Dengan arah yang jelas dan komitmen dari semua pihak, digitalisasi bisnis di Indonesia berpotensi menjadi pendorong utama pertumbuhan ekonomi nasional. Ke depan, perusahaan yang mampu berinovasi dan beradaptasi dengan teknologi akan menjadi pelaku utama dalam membentuk masa depan ekonomi yang lebih kuat, tangguh, dan inklusif."
            ],

            // bagian dibawah ini hanyalah kopian dari tiga diatas
            [
                'title' => 'Kebangkitan UMKM di Era Digital', 
                'description' => 'Transformasi digital membawa angin segar bagi UMKM di Indonesia',
                'image' => '/storage/news/umkm_digital.jpg',
                'view' => rand(1, 2500),
                'date' => '2025-06-04', 
                'content' => "Di tengah pesatnya perkembangan teknologi, usaha mikro, kecil, dan menengah (UMKM) mulai menunjukkan taringnya dalam ekosistem digital. Pemanfaatan platform online seperti marketplace, media sosial, hingga aplikasi kasir digital memberikan ruang baru bagi UMKM untuk tumbuh dan bersaing di pasar yang lebih luas.\n
                    \n
                    Pemerintah Indonesia pun terus mendorong transformasi ini melalui berbagai program pelatihan dan bantuan modal berbasis teknologi. Tujuannya adalah untuk meningkatkan literasi digital pelaku UMKM agar mampu memanfaatkan teknologi dengan maksimal dalam menjalankan usahanya.\n
                    \n
                    Tidak hanya itu, pandemi COVID-19 yang lalu juga menjadi pemicu utama UMKM untuk beradaptasi lebih cepat dengan sistem digital. Banyak pelaku usaha yang sebelumnya hanya mengandalkan toko fisik, kini berhasil mengembangkan usaha mereka secara daring dengan hasil yang lebih menjanjikan.\n
                    \n
                    Dengan dukungan infrastruktur digital yang terus berkembang dan peningkatan kualitas sumber daya manusia, UMKM di Indonesia memiliki potensi besar menjadi tulang punggung ekonomi nasional di era digital yang semakin kompetitif ini."
            ],
            [
                'title' => 'Strategi Bisnis Berkelanjutan di Tengah Tantangan Global', 
                'description' => 'Perusahaan dituntut untuk beradaptasi dengan prinsip keberlanjutan demi daya saing jangka panjang.',
                'image' => '/storage/news/strategi_bisnis_global.png',
                'view' => rand(1, 2500),
                'date' => '2025-06-04', 
                'content' => "Dalam menghadapi tantangan global seperti perubahan iklim, krisis energi, dan fluktuasi ekonomi, perusahaan dituntut untuk menerapkan strategi bisnis yang berkelanjutan. Konsep sustainability kini tidak lagi menjadi pilihan, melainkan keharusan bagi pelaku usaha yang ingin bertahan dalam jangka panjang.\n
                    \n
                    Prinsip bisnis berkelanjutan mencakup efisiensi penggunaan sumber daya, pengurangan limbah, dan penerapan praktik ramah lingkungan dalam setiap aspek operasional. Tidak hanya itu, aspek sosial seperti kesejahteraan karyawan, keterlibatan komunitas, dan transparansi bisnis juga menjadi indikator penting dalam menilai keberhasilan suatu perusahaan.\n
                    \n
                    Banyak perusahaan besar di dunia telah berinvestasi pada energi terbarukan, teknologi hijau, dan sistem produksi rendah emisi. Mereka menyadari bahwa keberlanjutan bukan hanya tanggung jawab sosial, tetapi juga kunci daya saing dalam pasar global yang semakin sadar lingkungan.\n
                    \n
                    Ke depan, pelaku usaha yang mampu menyeimbangkan antara keuntungan ekonomi dan dampak sosial-lingkungan akan menjadi pionir dalam industri mereka. Strategi berkelanjutan bukan hanya menciptakan citra positif, tetapi juga membuka peluang inovasi dan pertumbuhan jangka panjang."
            ],
            [
                'title' => 'Digitalisasi Bisnis sebagai Kunci Pertumbuhan Ekonomi Nasional', 
                'description' => 'Transformasi digital menjadi faktor utama dalam percepatan pertumbuhan bisnis di Indonesia.',
                'image' => '/storage/news/digitalisasi_bisnis.webp',
                'view' => rand(1, 2500),
                'date' => '2025-05-29', 
                'content' => "Perkembangan teknologi digital telah membawa perubahan besar dalam lanskap bisnis global, termasuk di Indonesia. Digitalisasi bukan lagi sebuah pilihan, melainkan kebutuhan yang harus diadopsi oleh seluruh pelaku usaha, baik skala besar maupun kecil, untuk bertahan dan berkembang di tengah kompetisi yang semakin ketat.\n
                    \n
                    Transformasi digital tidak hanya mencakup kehadiran bisnis di dunia maya, tetapi juga integrasi teknologi dalam proses produksi, distribusi, hingga pelayanan konsumen. Dengan sistem berbasis digital, perusahaan dapat meningkatkan efisiensi operasional, menekan biaya produksi, serta memperluas jangkauan pasar tanpa batasan geografis.\n
                    \n
                    Salah satu sektor yang merasakan manfaat besar dari digitalisasi adalah sektor ritel. Melalui platform e-commerce, banyak pelaku usaha dapat menjual produk mereka secara langsung kepada konsumen tanpa harus membuka toko fisik. Hal ini tidak hanya mengurangi beban biaya, tetapi juga memberikan fleksibilitas dalam mengatur strategi pemasaran dan penjualan.\n
                    \n
                    Di sisi lain, adopsi teknologi juga memungkinkan pengumpulan data konsumen secara real-time yang bisa dimanfaatkan untuk merancang produk dan layanan yang lebih tepat sasaran. Kecerdasan buatan (AI), analisis data, dan otomatisasi proses bisnis kini menjadi alat penting untuk meningkatkan kualitas layanan dan pengalaman pelanggan.\n
                    \n
                    Namun, proses digitalisasi juga membawa tantangan tersendiri, terutama bagi usaha kecil dan menengah yang masih memiliki keterbatasan dalam hal infrastruktur dan sumber daya manusia. Oleh karena itu, dukungan dari pemerintah, sektor swasta, dan institusi pendidikan sangat dibutuhkan untuk membangun ekosistem digital yang inklusif dan berkelanjutan.\n
                    \n
                    Pemerintah Indonesia sendiri telah meluncurkan berbagai inisiatif seperti program literasi digital, pelatihan teknologi, serta kemudahan perizinan bagi startup dan UMKM digital. Kebijakan ini diharapkan mampu mendorong lebih banyak pelaku usaha untuk berani bertransformasi dan ikut serta dalam perekonomian digital nasional.\n
                    \n
                    Dengan arah yang jelas dan komitmen dari semua pihak, digitalisasi bisnis di Indonesia berpotensi menjadi pendorong utama pertumbuhan ekonomi nasional. Ke depan, perusahaan yang mampu berinovasi dan beradaptasi dengan teknologi akan menjadi pelaku utama dalam membentuk masa depan ekonomi yang lebih kuat, tangguh, dan inklusif."
            ],
            [
                'title' => 'Kebangkitan UMKM di Era Digital', 
                'description' => 'Transformasi digital membawa angin segar bagi UMKM di Indonesia',
                'image' => '/storage/news/umkm_digital.jpg',
                'view' => rand(1, 2500),
                'date' => '2025-05-25', 
                'content' => "Di tengah pesatnya perkembangan teknologi, usaha mikro, kecil, dan menengah (UMKM) mulai menunjukkan taringnya dalam ekosistem digital. Pemanfaatan platform online seperti marketplace, media sosial, hingga aplikasi kasir digital memberikan ruang baru bagi UMKM untuk tumbuh dan bersaing di pasar yang lebih luas.\n
                    \n
                    Pemerintah Indonesia pun terus mendorong transformasi ini melalui berbagai program pelatihan dan bantuan modal berbasis teknologi. Tujuannya adalah untuk meningkatkan literasi digital pelaku UMKM agar mampu memanfaatkan teknologi dengan maksimal dalam menjalankan usahanya.\n
                    \n
                    Tidak hanya itu, pandemi COVID-19 yang lalu juga menjadi pemicu utama UMKM untuk beradaptasi lebih cepat dengan sistem digital. Banyak pelaku usaha yang sebelumnya hanya mengandalkan toko fisik, kini berhasil mengembangkan usaha mereka secara daring dengan hasil yang lebih menjanjikan.\n
                    \n
                    Dengan dukungan infrastruktur digital yang terus berkembang dan peningkatan kualitas sumber daya manusia, UMKM di Indonesia memiliki potensi besar menjadi tulang punggung ekonomi nasional di era digital yang semakin kompetitif ini."
            ],
            [
                'title' => 'Strategi Bisnis Berkelanjutan di Tengah Tantangan Global', 
                'description' => 'Perusahaan dituntut untuk beradaptasi dengan prinsip keberlanjutan demi daya saing jangka panjang.',
                'image' => '/storage/news/strategi_bisnis_global.png',
                'view' => rand(1, 2500),
                'date' => '2025-06-04', 
                'content' => "Dalam menghadapi tantangan global seperti perubahan iklim, krisis energi, dan fluktuasi ekonomi, perusahaan dituntut untuk menerapkan strategi bisnis yang berkelanjutan. Konsep sustainability kini tidak lagi menjadi pilihan, melainkan keharusan bagi pelaku usaha yang ingin bertahan dalam jangka panjang.\n
                    \n
                    Prinsip bisnis berkelanjutan mencakup efisiensi penggunaan sumber daya, pengurangan limbah, dan penerapan praktik ramah lingkungan dalam setiap aspek operasional. Tidak hanya itu, aspek sosial seperti kesejahteraan karyawan, keterlibatan komunitas, dan transparansi bisnis juga menjadi indikator penting dalam menilai keberhasilan suatu perusahaan.\n
                    \n
                    Banyak perusahaan besar di dunia telah berinvestasi pada energi terbarukan, teknologi hijau, dan sistem produksi rendah emisi. Mereka menyadari bahwa keberlanjutan bukan hanya tanggung jawab sosial, tetapi juga kunci daya saing dalam pasar global yang semakin sadar lingkungan.\n
                    \n
                    Ke depan, pelaku usaha yang mampu menyeimbangkan antara keuntungan ekonomi dan dampak sosial-lingkungan akan menjadi pionir dalam industri mereka. Strategi berkelanjutan bukan hanya menciptakan citra positif, tetapi juga membuka peluang inovasi dan pertumbuhan jangka panjang."
            ],
            [
                'title' => 'Digitalisasi Bisnis sebagai Kunci Pertumbuhan Ekonomi Nasional', 
                'description' => 'Transformasi digital menjadi faktor utama dalam percepatan pertumbuhan bisnis di Indonesia.',
                'image' => '/storage/news/digitalisasi_bisnis.webp',
                'view' => rand(1, 2500),
                'date' => '2025-05-25', 
                'content' => "Perkembangan teknologi digital telah membawa perubahan besar dalam lanskap bisnis global, termasuk di Indonesia. Digitalisasi bukan lagi sebuah pilihan, melainkan kebutuhan yang harus diadopsi oleh seluruh pelaku usaha, baik skala besar maupun kecil, untuk bertahan dan berkembang di tengah kompetisi yang semakin ketat.\n
                    \n
                    Transformasi digital tidak hanya mencakup kehadiran bisnis di dunia maya, tetapi juga integrasi teknologi dalam proses produksi, distribusi, hingga pelayanan konsumen. Dengan sistem berbasis digital, perusahaan dapat meningkatkan efisiensi operasional, menekan biaya produksi, serta memperluas jangkauan pasar tanpa batasan geografis.\n
                    \n
                    Salah satu sektor yang merasakan manfaat besar dari digitalisasi adalah sektor ritel. Melalui platform e-commerce, banyak pelaku usaha dapat menjual produk mereka secara langsung kepada konsumen tanpa harus membuka toko fisik. Hal ini tidak hanya mengurangi beban biaya, tetapi juga memberikan fleksibilitas dalam mengatur strategi pemasaran dan penjualan.\n
                    \n
                    Di sisi lain, adopsi teknologi juga memungkinkan pengumpulan data konsumen secara real-time yang bisa dimanfaatkan untuk merancang produk dan layanan yang lebih tepat sasaran. Kecerdasan buatan (AI), analisis data, dan otomatisasi proses bisnis kini menjadi alat penting untuk meningkatkan kualitas layanan dan pengalaman pelanggan.\n
                    \n
                    Namun, proses digitalisasi juga membawa tantangan tersendiri, terutama bagi usaha kecil dan menengah yang masih memiliki keterbatasan dalam hal infrastruktur dan sumber daya manusia. Oleh karena itu, dukungan dari pemerintah, sektor swasta, dan institusi pendidikan sangat dibutuhkan untuk membangun ekosistem digital yang inklusif dan berkelanjutan.\n
                    \n
                    Pemerintah Indonesia sendiri telah meluncurkan berbagai inisiatif seperti program literasi digital, pelatihan teknologi, serta kemudahan perizinan bagi startup dan UMKM digital. Kebijakan ini diharapkan mampu mendorong lebih banyak pelaku usaha untuk berani bertransformasi dan ikut serta dalam perekonomian digital nasional.\n
                    \n
                    Dengan arah yang jelas dan komitmen dari semua pihak, digitalisasi bisnis di Indonesia berpotensi menjadi pendorong utama pertumbuhan ekonomi nasional. Ke depan, perusahaan yang mampu berinovasi dan beradaptasi dengan teknologi akan menjadi pelaku utama dalam membentuk masa depan ekonomi yang lebih kuat, tangguh, dan inklusif."
            ]
        ]);
    }
}
