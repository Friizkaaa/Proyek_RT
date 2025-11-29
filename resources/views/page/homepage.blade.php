<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RT.08 Seminyak</title>
    <link rel="stylesheet" href="/css/dhome/homepage.css?v=3">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-white">

        <!-- NAVBAR -->
        <header>
        <div class="container">
            <!-- Logo -->
            <a href="#beranda" class="flex items-center gap-2">
                <img src="assets/logo.png" alt="Logo" style="width: 145px; height: 50px;">
            </a>

            <!-- Menu -->
            <nav>
            <a href="#beranda">BERANDA</a>
            <a href="#profil">PROFIL</a>
            <a href="#kalender">KALENDER</a>
            <a href="#galeri">GALERI</a>
            @if (Auth::check() && Auth::user()->role === 'Admin')
                <a href="#wargaku">WARGAKU</a>
            @endif
            </nav>

            <!-- Auth Section (akan diisi oleh JS) -->
            @auth
            <div id="">
                <button class="btn-welcome" onclick="showLogoutPopup()">
                    Selamat Datang, {{ $username }}
                </button>
            </div>
            @endauth

            @guest
                <div class="auth-buttons">
                    <a href="/page/masukpage" class="btn-masuk">MASUK</a>
                    <a href="/page/daftarpage" class="btn-daftar">DAFTAR</a>
                </div>
            @endguest
        </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="pt-24">

        <!-- HERO SECTION -->
        <section id="beranda" class="hero">
            <div class="hero-content text-left">
                <h1 class="hero-title">
                    Selamat Datang!<br>
                    Di RT. 08 <br>
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
                    <button id="prev-month"><</button>
                    <span id="calendar-month"></span>
                    <button id="next-month">></button>
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
        GALERI KEGIATAN
    ========================== -->
    <section id="galeri" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-6xl">
            <h2 class="text-3xl font-bold text-green-800 mb-10 text-center">Galeri</h2>

            <!-- Kontainer Slider --> 
            <div class="galeri-slider-container px-4"> 
                <button class="slide-btn prev"><</button> 
                
                <div class="galeri-slider" id="">
                    <!-- Item akan di-generate oleh JS -->
                    @foreach ($foto as $item )
                        <button class="btn-delete-galeri" onclick="">×</button>
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="">
                        <div class="desc">
                            <h3 class="font-bold text-green-800"></h3>
                            <p class="text-sm mt-2 text-gray-700">
                                 {{ $item->deskripsi }}
                                <span class="block mt-1 text-gray-500"></span>
                            </p>
                        </div>
                    @endforeach
                </div>

                <button class="slide-btn next">></button>
            </div>

            @if (Auth::check() && (Auth::user()->role === 'Warga' || Auth::user()->role === 'Admin'))
                <!-- Tombol Tambah Galeri (akan diisi oleh JS) -->
                <div id="galeri-actions" class="text-center">
                    <a href="{{ route('get-galeri') }}" class="add-galeri-btn">
                        Tambah Galeri / Berita
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- ==========================
        FITUR WARGAKU
    ========================== -->
    @if (Auth::check() && Auth::user()->role === 'Admin')
        <section id="wargaku" class="py-20 bg-white">
            <div class="container mx-auto px-6 max-w-6xl">
                <h2 class="wargaku-title">Wargaku</h2>

                <!-- Tabel Daftar Warga -->
                <div class="wargaku-container">
                    <table class="wargaku-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="wargaku-list">
                            <tr>
                                @foreach ( $users as $user )
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="aksi-btn" onclick="lihatWarga(${warga.id})">Lihat</button>
                                </td>
                                @endforeach
                            </tr>
                            
                            <!-- Data akan di-generate oleh JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif

    <!-- FOOTER -->
    <footer class="bg-gray-200 py-4 mt-20">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-500 text-sm">
                &copy; 2025 RT.08 Seminyak. All Rights Reserved.
            </p>
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

    <!-- ✅ SCRIPT UNTUK DYNAMICS USER (Guest vs Warga) -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const authSection = document.getElementById('auth-section');
        const galeriActions = document.getElementById('galeri-actions');

        if (localStorage.getItem('isLoggedIn') === 'true') {
            const nama = localStorage.getItem('userNama') || 'Warga';
            const role = localStorage.getItem('userRole') || 'warga';

            authSection.innerHTML = `
                <button class="btn-welcome" onclick="showLogoutPopup()">
                    Selamat Datang, ${nama}
                </button>
            `;

            if (role === 'warga' || role === 'admin') {
                galeriActions.innerHTML = `
                    <a href="/page/formgaleri" class="add-galeri-btn">
                        Tambah Galeri / Berita
                    </a>
                `;
            }
        } else {
            authSection.innerHTML = `
                <div class="auth-buttons">
                    <a href="/page/masukpage" class="btn-masuk">MASUK</a>
                    <a href="/page/daftarpage" class="btn-daftar">DAFTAR</a>
                </div>
            `;
            galeriActions.innerHTML = '';
        }
    });
    </script>

    <!-- ✅ SCRIPT KALENDER - UNTUK WARGA & ADMIN -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const calendar = document.getElementById("calendar");
        const eventDetails = document.getElementById("event-details");
        const calendarMonth = document.getElementById("calendar-month");
        const prevBtn = document.getElementById("prev-month");
        const nextBtn = document.getElementById("next-month");

        // Load data dari localStorage atau gunakan default
        let events = JSON.parse(localStorage.getItem('kalenderRT08')) || {
            "2025-11-02": ["Kegiatan 1", "Kegiatan 2", "Kegiatan 3"],
            "2025-11-03": ["Rapat koordinasi pengurus pukul 09.00 WIB"],
            "2025-11-07": ["Kerja bakti lingkungan pukul 07.00 WIB"],
            "2025-11-12": ["Rapat warga di Balai RT pukul 19.00 WIB"],
            "2025-11-20": ["Peringatan Hari Kemerdekaan - Lomba antar warga"]
        };

        // Cek role user
        const userRole = localStorage.getItem('userRole');
        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
        const isAdmin = userRole === 'admin';
        const isWarga = userRole === 'warga';

        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        function saveEvents() {
            localStorage.setItem('kalenderRT08', JSON.stringify(events));
        }

        // Fungsi hapus dengan popup kustom (Kalender)
        window.confirmDelete = function(dateKey, index) {
            const popup = document.createElement('div');
            popup.className = 'delete-confirm-popup';

            popup.innerHTML = `
                <div class="delete-confirm-content">
                    <h3>Apakah anda yakin ingin menghapus kegiatan ini?</h3>
                    <div class="delete-confirm-image">
                        <img src="/assets/hapuspopup.png" alt="Konfirmasi Hapus">
                    </div>
                    <div class="delete-confirm-buttons">
                        <button class="delete-confirm-btn btn-cancel" onclick="document.body.removeChild(this.closest('.delete-confirm-popup'))">KEMBALI</button>
                        <button class="delete-confirm-btn btn-confirm" onclick="handleDelete('${dateKey}', ${index})">YAKIN</button>
                    </div>
                </div>
            `;

            document.body.appendChild(popup);
        };

        function handleDelete(dateKey, index) {
            let events = JSON.parse(localStorage.getItem('kalenderRT08') || '{}');
            
            if (events[dateKey] && events[dateKey][index] !== undefined) {
                events[dateKey].splice(index, 1);
                if (events[dateKey].length === 0) {
                    delete events[dateKey];
                }
                localStorage.setItem('kalenderRT08', JSON.stringify(events));
                
                const currentMonth = new Date().getMonth();
                const currentYear = new Date().getFullYear();
                renderCalendar(currentMonth, currentYear);
                document.querySelector(`.day[data-date="${dateKey}"]`).click();
            }

            // Tutup popup
            document.querySelector('.delete-confirm-popup')?.remove();
        }

        function renderCalendar(month, year) {
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const offset = firstDay === 0 ? 6 : firstDay - 1;

            calendarMonth.textContent = `${new Date(year, month).toLocaleString("id-ID", { month: "long" })} ${year}`;

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
                    <div class="day" data-day="${i}" data-date="${dateKey}">
                        ${i}
                        <div class="dots-container">${dotsHtml}</div>
                    </div>
                `;
            }
            calendar.innerHTML = html;

            document.querySelectorAll(".day").forEach(day => {
                day.addEventListener("click", () => {
                    const dateKey = day.getAttribute("data-date");

                    document.querySelectorAll(".day").forEach(d => d.classList.remove("selected"));
                    day.classList.add("selected");

                    let listHtml = "";

                    if (events[dateKey] && events[dateKey].length > 0) {
                        listHtml += "<ul>";
                        events[dateKey].forEach((kegiatan, index) => {
                            if (isLoggedIn) {
                                listHtml += `
                                    <li>
                                        ${kegiatan}
                                        <button class="btn-delete-inline" onclick="confirmDelete('${dateKey}', ${index})">×</button>
                                    </li>
                                `;
                            } else {
                                listHtml += `<li>${kegiatan}</li>`;
                            }
                        });
                        listHtml += "</ul>";
                    } else {
                        listHtml += "<p>Tidak ada kegiatan di tanggal ini.</p>";
                    }

                    if (isLoggedIn && (isWarga || isAdmin)) {
                        listHtml += `
                            <a href="/page/formact?tanggal=${dateKey}" class="event-btn btn-outline">
                                + Tambah Kegiatan
                            </a>
                        `;
                    }

                    eventDetails.innerHTML = listHtml;
                });
            });
        }

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

        renderCalendar(currentMonth, currentYear);
    });
    </script>

    <!-- ✅ SCRIPT UNTUK GALERI DINAMIS + HAPUS -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const galeriSlider = document.getElementById('galeri-slider');
        const slideBtnPrev = document.querySelector('.slide-btn.prev');
        const slideBtnNext = document.querySelector('.slide-btn.next');

        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

        // Load data galeri dari localStorage
        // let galeri = JSON.parse(localStorage.getItem('galeriRT08')) || [
        //     { id: 1, foto: 'galeri-placeholder.jpg', judul: 'Galeri Kegiatan 1', deskripsi: 'Contoh kegiatan desa.', tanggal: 'Juni 2024' },
        //     { id: 2, foto: 'galeri-placeholder.jpg', judul: 'Galeri Kegiatan 2', deskripsi: 'Contoh kegiatan desa.', tanggal: 'Juli 2024' },
        //     { id: 3, foto: 'galeri-placeholder.jpg', judul: 'Galeri Kegiatan 3', deskripsi: 'Contoh kegiatan desa.', tanggal: 'Agustus 2024' },
        //     { id: 4, foto: 'galeri-placeholder.jpg', judul: 'Galeri Kegiatan 4', deskripsi: 'Contoh kegiatan desa.', tanggal: 'September 2024' }
        // ];

        // Render galeri
        function renderGaleri() {
            galeriSlider.innerHTML = '';
            galeri.forEach(item => {
                const itemEl = document.createElement('div');
                itemEl.className = 'galeri-item';
                
                let deleteBtn = '';
                if (isLoggedIn) {
                    deleteBtn = `<button class="btn-delete-galeri" onclick="confirmDeleteGaleri(${item.id})">×</button>`;
                }

                itemEl.innerHTML = `
                    ${deleteBtn}
                    <img src="${item.foto}" alt="${item.judul}">
                    <div class="desc">
                        <h3 class="font-bold text-green-800">${item.judul}</h3>
                        <p class="text-sm mt-2 text-gray-700">
                            ${item.deskripsi}
                            <span class="block mt-1 text-gray-500">- ${item.tanggal}</span>
                        </p>
                    </div>
                `;
                galeriSlider.appendChild(itemEl);
            });
        }

        renderGaleri();

        // Scroll buttons
        if (slideBtnPrev && slideBtnNext) {
            slideBtnPrev.addEventListener('click', () => {
                galeriSlider.scrollBy({ left: -300, behavior: 'smooth' });
            });

            slideBtnNext.addEventListener('click', () => {
                galeriSlider.scrollBy({ left: 300, behavior: 'smooth' });
            });

            // Auto show/hide buttons based on scroll
            galeriSlider.addEventListener('scroll', () => {
                const maxScroll = galeriSlider.scrollWidth - galeriSlider.clientWidth;
                slideBtnPrev.style.display = galeriSlider.scrollLeft > 0 ? 'block' : 'none';
                slideBtnNext.style.display = galeriSlider.scrollLeft < maxScroll ? 'block' : 'none';
            });

            // Initial state
            slideBtnPrev.style.display = 'none';
        }
    });

    // Fungsi hapus galeri dengan popup kustom
    window.confirmDeleteGaleri = function(id) {
        const popup = document.createElement('div');
        popup.className = 'delete-confirm-popup';

        popup.innerHTML = `
            <div class="delete-confirm-content">
                <h3>Apakah anda yakin ingin menghapus Galeri ini?</h3>
                <div class="delete-confirm-image">
                    <img src="/assets/hapuspopup.png" alt="Konfirmasi Hapus Galeri">
                </div>
                <div class="delete-confirm-buttons">
                    <button class="delete-confirm-btn btn-cancel" onclick="document.body.removeChild(this.closest('.delete-confirm-popup'))">KEMBALI</button>
                    <button class="delete-confirm-btn btn-confirm" onclick="handleDeleteGaleri(${id})">YAKIN</button>
                </div>
            </div>
        `;

        document.body.appendChild(popup);
    };

    // Fungsi penanganan hapus galeri
    function handleDeleteGaleri(id) {
        let galeri = JSON.parse(localStorage.getItem('galeriRT08')) || [];
        galeri = galeri.filter(item => item.id !== id);
        localStorage.setItem('galeriRT08', JSON.stringify(galeri));
        
        // Re-render galeri
        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
        const galeriSlider = document.getElementById('galeri-slider');
        galeriSlider.innerHTML = '';

        galeri.forEach(item => {
            const itemEl = document.createElement('div');
            itemEl.className = 'galeri-item';
            let deleteBtn = '';
            if (isLoggedIn) {
                deleteBtn = `<button class="btn-delete-galeri" onclick="confirmDeleteGaleri(${item.id})">×</button>`;
            }
            itemEl.innerHTML = `
                ${deleteBtn}
                <img src="${item.foto}" alt="${item.judul}">
                <div class="desc">
                    <h3 class="font-bold text-green-800">${item.judul}</h3>
                    <p class="text-sm mt-2 text-gray-700">
                        ${item.deskripsi}
                        <span class="block mt-1 text-gray-500">- ${item.tanggal}</span>
                    </p>
                </div>
            `;
            galeriSlider.appendChild(itemEl);
        });

        // Tutup popup
        document.querySelector('.delete-confirm-popup')?.remove();
    }

    // ✅ SCRIPT UNTUK LOAD DAFTAR WARGA DARI LOCALSTORAGE
document.addEventListener("DOMContentLoaded", function () {
    const wargakuList = document.getElementById('wargaku-list');
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const userRole = localStorage.getItem('userRole');

    // Contoh data warga (nanti bisa dari backend)
    let wargaList = JSON.parse(localStorage.getItem('daftarWarga')) || [
        { id: 1, nama: 'Frizkaaulia', email: 'frizka@example.com', role: 'admin' },
        { id: 2, nama: 'Budi Santoso', email: 'budi@example.com', role: 'warga' },
        { id: 3, nama: 'Siti Rahayu', email: 'siti@example.com', role: 'warga' },
        { id: 4, nama: 'Agus Prasetyo', email: 'agus@example.com', role: 'warga' }
    ];

    // Render daftar warga
    function renderWarga() {
        wargakuList.innerHTML = '';
        wargaList.forEach((warga, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${warga.nama}</td>
                <td>
                    <button class="aksi-btn" onclick="lihatWarga(${warga.id})">Lihat</button>
                </td>
            `;
            wargakuList.appendChild(row);
        });
    }

    renderWarga();

    // Fungsi lihat warga - versi popup kustom
    window.lihatWarga = function(id) {
        const warga = wargaList.find(w => w.id === id);
        if (!warga) return;

        const popup = document.createElement('div');
        popup.className = 'detail-warga-popup';

        popup.innerHTML = `
            <div class="detail-warga-content">
                <div class="detail-warga-image">
                    <img src="/assets/hapuspopup.png" alt="Detail Warga">
                </div>
                <div class="detail-warga-data">
                    <p><strong>Nama Lengkap:</strong> ${warga.nama_lengkap || warga.nama}</p>
                    <p><strong>NIK:</strong> ${warga.nik || 'Tidak tersedia'}</p>
                    <p><strong>Alamat:</strong> ${warga.alamat || 'Tidak tersedia'}</p>
                    <p><strong>Tanggal Lahir:</strong> ${warga.tanggal_lahir || 'Tidak tersedia'}</p>
                    <p><strong>Pekerjaan:</strong> ${warga.pekerjaan || 'Tidak tersedia'}</p>
                    <p><strong>Status Keluarga:</strong> ${warga.status_keluarga || 'Tidak tersedia'}</p>
                    <p><strong>Nomor HP:</strong> ${warga.nomor_hp || 'Tidak tersedia'}</p>
                </div>
                <button class="detail-warga-btn" onclick="document.body.removeChild(this.closest('.detail-warga-popup'))">TUTUP</button>
            </div>
        `;

        document.body.appendChild(popup);
    };
});

// Fungsi tampilkan popup logout
window.showLogoutPopup = function() {
    const popup = document.createElement('div');
    popup.className = 'logout-confirm-popup';

    popup.innerHTML = `
        <div class="logout-confirm-content">
            <h3>Apakah Anda yakin ingin keluar?</h3>
            <div class="logout-confirm-image">
                <img src="/assets/hapuspopup.png" alt="Konfirmasi Logout">
            </div>
            <div class="logout-confirm-buttons">
                <button class="logout-confirm-btn btn-cancel" onclick="document.body.removeChild(this.closest('.logout-confirm-popup'))">BATAL</button>
                <button class="logout-confirm-btn btn-logout" onclick="handleLogout()">LOG OUT</button>
            </div>
        </div>
    `;

    document.body.appendChild(popup);
};

// Fungsi handle logout
function handleLogout() {
    fetch("/logout", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        }
    }).then(() => {
        window.location.href = "/";
    });
}

    </script>

</body>
</html>