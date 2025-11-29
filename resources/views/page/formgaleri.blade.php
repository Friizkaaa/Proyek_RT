<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Galeri - RT.08 Seminyak</title>
    <link rel="stylesheet" href="/css/dhome/galeri.css?v=2">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h1>Tambah Galeri / Berita</h1>

            <!-- Peringatan Penting -->
            <div class="warning-box">
                <strong>MOHON PERHATIKAN!</strong> Postingan tidak dapat dihapus atau ditarik setelah dikirim.
            </div>

            <form id="galeriForm" method="POST" action="{{ route('post-galeri') }}" enctype="multipart/form-data">
                @csrf
                <!-- Foto -->
                <div class="input-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto" accept="image/*" required>
                </div>

                <!-- Judul -->
                <div class="input-group">
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan judul kegiatan" required maxlength="100">
                </div>

                <!-- Deskripsi -->
                <div class="input-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi singkat (maks. 200 karakter)" required maxlength="200"></textarea>
                    <div class="char-counter"><span id="char-count">0</span>/200</div>
                </div>

                <!-- Tanggal -->
                <div class="input-group">
                    <label for="tanggal">Tanggal Kegiatan</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-actions">
                    <a href="/#galeri" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const textarea = document.getElementById('deskripsi');
        const counter = document.getElementById('char-count');
        
        if (textarea && counter) {
            textarea.addEventListener('input', () => {
                const len = textarea.value.length;
                counter.textContent = len;
                counter.style.color = len > 190 ? '#e11d48' : '#4b5563';
            });
        }

        document.getElementById('galeriForm').addEventListener('submit', function(e) {
            // e.preventDefault();

            const judul = document.getElementById('judul').value.trim();
            const deskripsi = document.getElementById('deskripsi').value.trim();
            const tanggalInput = document.getElementById('tanggal');
            const fotoInput = document.getElementById('foto');

            // Validasi
            if (!judul || !deskripsi || !tanggalInput.value || !fotoInput.files[0]) {
                alert('Semua field wajib diisi, termasuk foto!');
                return;
            }

            // const tanggal = tanggalInput.value;
            // const file = fotoInput.files[0];

            // Untuk demo frontend-only: simpan nama file (bukan file asli)
            // Di backend nanti, file di-upload dan disimpan path-nya
            // const fotoNama = file.name;

            // Ambil galeri lama
            // let galeriList = JSON.parse(localStorage.getItem('galeriRT08')) || [];

            // Tambahkan entri baru
            // galeriList.unshift({
            //     id: Date.now(),
            //     foto: fotoNama, // hanya nama file (karena tidak ada upload beneran)
            //     judul: judul,
            //     deskripsi: deskripsi,
            //     tanggal: tanggal
            // });

            // Simpan
            // localStorage.setItem('galeriRT08', JSON.stringify(galeriList));

            // Buat popup sukses
            const successPopup = document.createElement('div');
            successPopup.className = 'success-popup';
            successPopup.innerHTML = `
                <div class="success-popup-content">
                    <h3>Galeri berhasil ditambahkan</h3>
                    <div class="success-popup-image">
                        <img src="/assets/addactpopup.png" alt="Sukses Tambah Galeri">
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
                    window.location.href = '/#galeri';
                }, 200); // waktu remove setelah fade out
            }, 1000);
        });
    </script>
</body>
</html>