<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - RT.08 Seminyak</title>
    <link rel="stylesheet" href="/css/dhome/masuk.css?v=2">
</head>

<body>
    <!-- Back Button -->
    <div class="back-button">
        <a href="/" class="back-link">← Kembali ke Beranda</a>
    </div>

    <div class="container">
        <div class="form-section">
            <h1>Masuk</h1>
            <p class="register-prompt">
                Belum memiliki akun? 
                <a href="/page/daftarpage" class="register-link">Daftar sekarang</a>
            </p>

            <!-- Form Login (tanpa action, handle via JS) -->
            <form id="loginForm">
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="@#*%" required>
                        <span class="toggle-password">👁️</span>
                    </div>
                </div>

                <button type="submit" class="next-btn">Masuk</button>
            </form>
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
        // Toggle password visibility
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

        // Simulasi login (frontend-only)
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            let nama = email.split('@')[0]
                .replace(/\./g, ' ')
                .replace(/[^a-zA-Z\s]/g, '')
                .replace(/\b\w/g, l => l.toUpperCase())
                .trim() || 'Warga';

            // Simpan sebagai WARGA
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('userNama', nama);
            localStorage.setItem('userRole', 'warga'); // <-- ini yang penting

            window.location.href = '/';
        });
    </script>
</body>
</html>