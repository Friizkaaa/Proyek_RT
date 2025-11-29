<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - RT.08 Seminyak</title>
    <link rel="stylesheet" href="/css/dhome/act.css?v=1">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h1>Tambah Kegiatan</h1>

            <!-- Ambil tanggal dari URL -->
            <p id="tanggal-label">Tanggal: <strong id="tanggal-value"></strong></p>

            <form id="kegiatanForm" method=" POST" action={{ route('post-formact') }}>
                @csrf
                <input type="hidden" id="tanggal" name="tanggal">

                <div class="input-group">
                    <label for="kegiatan">Deskripsi Kegiatan</label>
                    <textarea id="kegiatan" name="kegiatan" placeholder="Contoh: Rapat warga pukul 19.00 WIB" required maxlength="200"></textarea>
                    <div class="char-counter"><span id="char-count">0</span>/200</div>
                </div>

                <div class="form-actions">
                    <a href="/#kalender" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Ambil tanggal dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const tanggal = urlParams.get('tanggal');
        if (tanggal) {
            document.getElementById('tanggal').value = tanggal;
            const tanggalFormatted = new Date(tanggal).toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            document.getElementById('tanggal-value').textContent = tanggalFormatted;
        }

        // Counter
        const textarea = document.getElementById('kegiatan');
        const counter = document.getElementById('char-count');
        textarea.addEventListener('input', () => {
            counter.textContent = textarea.value.length;
        });

        // Simpan ke localStorage & redirect
        document.getElementById('kegiatanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const kegiatan = textarea.value.trim();
            const tgl = document.getElementById('tanggal').value;

            if (kegiatan && tgl) {
                let events = JSON.parse(localStorage.getItem('kalenderRT08') || '{}');
                if (!events[tgl]) events[tgl] = [];
                events[tgl].push(kegiatan);
                localStorage.setItem('kalenderRT08', JSON.stringify(events));

                // Buat popup sukses
                const successPopup = document.createElement('div');
                successPopup.className = 'success-popup';
                successPopup.innerHTML = `
                    <div class="success-popup-content">
                        <h3>Kegiatan Berhasil di tambahkan</h3>
                        <div class="success-popup-image">
                            <img src="/assets/addactpopup.png" alt="Sukses Tambah Kegiatan">
                        </div>
                    </div>
                `;
                document.body.appendChild(successPopup);

                // Tampilkan popup
                setTimeout(() => {
                    successPopup.classList.add('show');
                }, 10);

                // Redirect setelah 1 detik
                setTimeout(() => {
                    successPopup.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(successPopup);
                        window.location.href = '/#kalender';
                    }, 200); // waktu remove setelah fade out
                }, 1000);
            }
        });
    </script>
</body>
</html>