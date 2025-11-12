<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT.08 Seminyak</title>
    <link rel="stylesheet" href="/css/dhome/homepage.css?v=2">    <style>
        html {
            scroll-behavior: smooth; /* smooth scroll untuk single page */
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-white">

    <!-- NAVBAR -->
    <header class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo -->
            <a href="#beranda" class="flex items-center gap-2 font-bold text-green-800 text-lg">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-8">
                RT.08 Seminyak
            </a>

            <!-- Menu -->
            <nav class="hidden md:flex gap-6 font-medium">
                <a href="#beranda" class="hover:text-green-700 transition-colors">BERANDA</a>
                <a href="#profil" class="hover:text-green-700 transition-colors">PROFIL</a>
                <a href="#kalender" class="hover:text-green-700 transition-colors">KALENDER</a>
                <a href="#galeri" class="hover:text-green-700 transition-colors">GALERI</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="hidden md:flex gap-4">
                <a href="#" class="hover:text-green-700 transition-colors">MASUK</a>
                <a href="#" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition-colors">DAFTAR</a>
            </div>
        </div>
    </header>

        <!-- MAIN CONTENT -->
        <main class="pt-24">

        <!-- HERO SECTION -->
        <section id="beranda" class="hero">
            <div class="hero-content text-left">
                <h1 class="hero-title">
                    Selamat Datang!<br>
                    Di RT. 08 Kuta<br>
                    Bali, Indonesia
                </h1>
            </div>
        </section>

        <!-- PROFIL RT 08 -->
        <section id="profil" class="py-20 bg-white">
            <div class="container mx-auto px-6 text-center max-w-3xl">
                <h2 class="text-3xl font-bold text-green-800 mb-6">Profil RT. 08</h2>
                <p class="mb-4">Assalamu'alaikum warahmatullahi wabarakatuh,</p>
                <p class="mb-4">Puji syukur kita panjatkan ke hadirat Allah SWT atas segala rahmat dan karunia-Nya. Website ini kami hadirkan sebagai sarana informasi dan komunikasi bagi warga RT, sekaligus wadah untuk mempererat kebersamaan, meningkatkan partisipasi, serta membangun lingkungan yang aman, nyaman, dan harmonis.</p>
                <p class="mb-4">Kami berharap website ini dapat mempermudah warga dalam mendapatkan informasi seputar kegiatan RT, pelayanan administrasi, serta menjadi media aspirasi untuk bersama-sama mewujudkan lingkungan yang lebih baik.</p>
                <p class="font-semibold mt-6 text-green-800">Salam hangat, Ketua RT</p>
            </div>
        </section>

<!-- ==========================
     KALENDER KEGIATAN
========================== -->
<section id="kalender">
    <div class="kalender-container">
        <h2>Kalender Kegiatan</h2>

        <!-- Header Bulan dengan tombol navigasi -->
        <div class="kalender-header">
            <button id="prev-month">&lt;</button>
            <span id="calendar-month"></span>
            <button id="next-month">&gt;</button>
        </div>

        <!-- Nama Hari -->
        <div class="kalender-weekdays">
            <div>M</div><div>S</div><div>Sl</div><div>R</div><div>K</div><div>J</div><div>Sb</div>
        </div>

        <!-- Grid Tanggal -->
        <div id="calendar"></div>

        <!-- Keterangan Event -->
        <div id="event-details">Pilih tanggal pada kalender untuk melihat kegiatan.</div>
    </div>
</section>

<!-- ==========================
     SCRIPT KALENDER
========================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const calendar = document.getElementById("calendar");
    const eventDetails = document.getElementById("event-details");
    const calendarMonth = document.getElementById("calendar-month");
    const prevBtn = document.getElementById("prev-month");
    const nextBtn = document.getElementById("next-month");

    // Contoh data kegiatan per tanggal (array tiap tanggal)
    const events = {
        "2025-11-02": ["Kegiatan 1", "Kegiatan 2", "Kegiatan 3"],
        "2025-11-03": ["Rapat koordinasi pengurus pukul 09.00 WIB"],
        "2025-11-07": ["Kerja bakti lingkungan pukul 07.00 WIB"],
        "2025-11-12": ["Rapat warga di Balai RT pukul 19.00 WIB"],
        "2025-11-20": ["Peringatan Hari Kemerdekaan - Lomba antar warga"]
    };

    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    function renderCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const offset = firstDay === 0 ? 6 : firstDay - 1;

        // Update header bulan
        calendarMonth.textContent = `${new Date(year, month).toLocaleString("id-ID", { month: "long" })} ${year}`;

        // Buat tanggal
        let html = "";
        for (let i = 0; i < offset; i++) html += "<div></div>";
        for (let i = 1; i <= daysInMonth; i++) {
            const dateKey = `${year}-${String(month+1).padStart(2,'0')}-${String(i).padStart(2,'0')}`;
            const count = events[dateKey] ? events[dateKey].length : 0;

            let dotsHtml = '';
            if (count > 0) {
                for (let j = 0; j < count; j++) {
                    dotsHtml += `<span class="event-dot"></span>`;
                }
            }

            html += `
                <div class="day" data-day="${i}">
                    ${i}
                    <div class="dots-container">${dotsHtml}</div>
                </div>
            `;
        }
        calendar.innerHTML = html;

        // Event klik tanggal
        document.querySelectorAll(".day").forEach(day => {
            day.addEventListener("click", () => {
                const selectedDay = day.getAttribute("data-day");
                const dateKey = `${year}-${String(month+1).padStart(2,'0')}-${String(selectedDay).padStart(2,'0')}`;

                // Reset semua
                document.querySelectorAll(".day").forEach(d => d.classList.remove("selected"));
                day.classList.add("selected");

                // Tampilkan list kegiatan
                if (events[dateKey]) {
                    let listHtml = "<ul>";
                    events[dateKey].forEach(ev => listHtml += `<li>${ev}</li>`);
                    listHtml += "</ul>";
                    eventDetails.innerHTML = listHtml;
                } else {
                    eventDetails.textContent = "Tidak ada kegiatan di tanggal ini.";
                }
            });
        });
    }

    // Tombol navigasi
    prevBtn.addEventListener("click", () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    nextBtn.addEventListener("click", () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    // Render awal
    renderCalendar(currentMonth, currentYear);
});
</script>

<!-- ==========================
     GALERI KEGIATAN
========================== -->
<section id="galeri" class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-3xl font-bold text-green-800 mb-10 text-center">Galeri</h2>

        <!-- Kontainer Slider --> 
        <div class="galeri-slider-container"> 
            <button class="slide-btn prev">&lt;</button> 
             
            <div class="galeri-slider"> 
                <!-- Dummy galeri --> 
                <div class="galeri-item">
                    <img src="{{ asset('galeri-placeholder.jpg') }}" alt="Galeri 1">
                    <div class="desc">
                        <h3 class="font-bold text-green-800">Galeri Kegiatan 1</h3>
                        <p class="text-sm mt-2 text-gray-700">
                            Contoh kegiatan desa.
                            <span class="block mt-1 text-gray-500">- Juni 2024</span>
                        </p>
                    </div>
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('galeri-placeholder.jpg') }}" alt="Galeri 2">
                    <div class="desc">
                        <h3 class="font-bold text-green-800">Galeri Kegiatan 2</h3>
                        <p class="text-sm mt-2 text-gray-700">
                            Contoh kegiatan desa.
                            <span class="block mt-1 text-gray-500">- Juli 2024</span>
                        </p>
                    </div>
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('galeri-placeholder.jpg') }}" alt="Galeri 3">
                    <div class="desc">
                        <h3 class="font-bold text-green-800">Galeri Kegiatan 3</h3>
                        <p class="text-sm mt-2 text-gray-700">
                            Contoh kegiatan desa.
                            <span class="block mt-1 text-gray-500">- Agustus 2024</span>
                        </p>
                    </div>
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('galeri-placeholder.jpg') }}" alt="Galeri 4">
                    <div class="desc">
                        <h3 class="font-bold text-green-800">Galeri Kegiatan 4</h3>
                        <p class="text-sm mt-2 text-gray-700">
                            Contoh kegiatan desa.
                            <span class="block mt-1 text-gray-500">- September 2024</span>
                        </p>
                    </div>
                </div>
            </div>

            <button class="slide-btn next">&gt;</button>
        </div>

        <!-- Tombol Tambah Galeri -->
        <div class="text-center">
            <a href="#" class="add-galeri-btn">
                Tambah Galeri / Berita
            </a>
        </div>
    </div>
</section>

<!-- ==========================
     SCRIPT SLIDER GALERI
========================== -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector('.galeri-slider');
    const prevBtn = document.querySelector('.slide-btn.prev');
    const nextBtn = document.querySelector('.slide-btn.next');
    const scrollAmount = 300;

    function updateButtons() {
        const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
        prevBtn.style.display = slider.scrollLeft > 0 ? 'block' : 'none';
        nextBtn.style.display = slider.scrollLeft < maxScrollLeft ? 'block' : 'none';
    }

    // Event tombol klik
    prevBtn.addEventListener('click', () => slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));
    nextBtn.addEventListener('click', () => slider.scrollBy({ left: scrollAmount, behavior: 'smooth' }));

    // Update tombol saat scroll
    slider.addEventListener('scroll', updateButtons);

    // Update tombol saat halaman load
    updateButtons();

    // Sembunyikan tombol next jika jumlah item <= 4
    if (slider.children.length <= 4) nextBtn.style.display = 'none';
});
</script>



    <!-- FOOTER -->
    <footer class="bg-gray-200 py-10 mt-20">
        <div class="container mx-auto px-6 text-center">
            <div class="flex justify-center gap-6 mb-4 text-2xl text-gray-600">
                <span>🌐</span>
                <span>📧</span>
                <span>📞</span>
            </div>
            <p class="text-gray-600 mb-4">About • Features • Pricing • Gallery • Team</p>
            <button class="border border-green-700 text-green-700 px-4 py-2 rounded hover:bg-green-700 hover:text-white transition-colors">
                Contact Us
            </button>
            <p class="text-gray-500 mt-6">&copy; 2025 RT.08 Seminyak. All Rights Reserved.</p>
        </div>
    </footer>

        <!-- ✅ SCRIPT BUAT NAVBAR ACTIVE -->
    <script>
      const navLinks = document.querySelectorAll("nav a");

      navLinks.forEach(link => {
        link.addEventListener("click", function() {
          navLinks.forEach(l => l.classList.remove("active"));
          this.classList.add("active");
        });
      });
    </script>

</body>
</html>
