<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - RT.08 Seminyak</title>
    <link rel="stylesheet" href="/css/dhome/daftar.css?v=3">
</head>

<body>
    <!-- Back Button -->
    <div class="back-button">
        <a href="/" class="back-link">← Kembali ke Beranda</a>
    </div>

    <div class="container">
        <div class="form-section">
            <!-- Bagian atas: TETAP, tidak scroll -->
            <h1>Daftar</h1>
            <p class="login-prompt">
                Sudah memiliki akun? 
                <a href="/page/masukpage" class="login-link">Masuk sekarang</a>
            </p>

            <!-- Bagian scrollable: hanya field input -->
            <div class="scrollable-form">
                <form action="#" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" placeholder="@#*%" required>
                            <span class="toggle-password">👁️</span>
                        </div>
                    </div>

                    <!-- Kode Warga (RAHASIA) -->
                    <div class="input-group">
                        <label for="kode_warga">Kode Warga</label>
                        <div class="password-wrapper">
                            <input type="password" id="kode_warga" name="kode_warga" placeholder="@#*%" required>
                            <span class="toggle-password">👁️</span>
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="input-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Contoh: I Made Jaya" required>
                    </div>

                    <!-- NIK -->
                    <div class="input-group">
                        <label for="nik">NIK</label>
                        <input type="number" id="nik" name="nik" placeholder="16 digit NIK" required min="1000000000000000" max="9999999999999999">
                    </div>

                    <!-- Alamat -->
                    <div class="input-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" placeholder="Alamat saat ini" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="input-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="input-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" id="pekerjaan" name="pekerjaan" placeholder="Contoh: Wiraswasta" required>
                    </div>

                    <!-- Status Keluarga -->
                    <div class="input-group">
                        <label for="status_keluarga">Status Keluarga</label>
                        <select id="status_keluarga" name="status_keluarga" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="kepala_keluarga">Kepala Keluarga</option>
                            <option value="anggota_keluarga">Anggota Keluarga</option>
                            <option value="lajang">Lajang</option>
                            <option value="janda/duda">Janda/Duda</option>
                        </select>
                    </div>

                    <!-- Nomor HP -->
                    <div class="input-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="tel" id="no_hp" name="no_hp" placeholder="081234567890" required pattern="[0-9]{10,13}">
                    </div>

                    <!-- Username -->
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Contoh: made_jaya" required minlength="4">
                    </div>

                    <!-- Hidden fields -->
                    <input type="hidden" name="role" value="warga">
                    <input type="hidden" name="kode_rt" value="8">

                    <a href="/page/masukpage" class="next-btn" style="text-decoration: none; display: block; text-align: center;">Daftar</a>
                </form>
            </div>
        </div>

        <div class="image-section">
            <img src="/assets/bali-features.jpg" alt="Bali Features">
            <div class="overlay-text">
                <h2>Introducing new features</h2>
                <p>Analyzing previous trends ensures that businesses always make the right decision. And as the scale of the decision and it’s impact magnifies...</p>
                <p class="source">laaurenjade.com</p>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.textContent = '🙈';
                } else {
                    input.type = 'password';
                    this.textContent = '👁️';
                }
            });
        });
    </script>
</body>
</html>