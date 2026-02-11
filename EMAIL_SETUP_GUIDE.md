# Panduan Setup Email Gmail untuk Reset Password

## ⚠️ Masalah

Email reset password tidak terkirim ke Gmail karena konfigurasi email belum diatur dengan benar.

## ✅ Solusi: Setup Gmail SMTP

### Langkah 1: Buat App Password Gmail

1. **Login ke Gmail** yang akan digunakan untuk mengirim email
2. **Buka Google Account Settings**: https://myaccount.google.com/
3. **Pilih Security** (Keamanan) di sidebar kiri
4. **Aktifkan 2-Step Verification** jika belum aktif:
    - Klik "2-Step Verification"
    - Ikuti langkah-langkah untuk mengaktifkannya
5. **Buat App Password**:
    - Setelah 2-Step Verification aktif, kembali ke Security page
    - Cari "App passwords" atau "Sandi aplikasi"
    - Klik dan login lagi jika diminta
    - Pilih "Select app" → pilih "Mail"
    - Pilih "Select device" → pilih "Other (Custom name)"
    - Ketik nama: "Laravel Catering App"
    - Klik "Generate"
    - **SIMPAN password 16 karakter yang muncul** (tanpa spasi)

### Langkah 2: Update File .env

Buka file `.env` dan update konfigurasi mail:

```env
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-anda@gmail.com
MAIL_PASSWORD=xxxx-xxxx-xxxx-xxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="email-anda@gmail.com"
MAIL_FROM_NAME="RS Catering"
```

**Ganti:**

- `email-anda@gmail.com` → email Gmail Anda yang asli
- `xxxx-xxxx-xxxx-xxxx` → App Password 16 karakter dari Langkah 1 (bisa dengan atau tanpa tanda dash)

### Langkah 3: Restart Server

```bash
# Stop server (Ctrl + C)
# Kemudian jalankan lagi
php artisan serve
```

### Langkah 4: Test Email

1. Buka halaman Lupa Password: http://localhost:8000/forgot-password
2. Masukkan email yang terdaftar
3. Klik "Kirim Link Reset Password"
4. Cek inbox Gmail (atau folder Spam)

## 📋 Troubleshooting

### Problem 1: "Authentication failed"

**Solusi:**

- Pastikan 2-Step Verification sudah aktif
- Buat App Password baru
- Pastikan tidak ada spasi di App Password
- Gunakan email dan password yang benar

### Problem 2: Email masuk ke Spam

**Solusi:**

- Normal untuk pertama kali
- Tandai sebagai "Not Spam"
- Untuk production, gunakan domain email sendiri dan setup SPF/DKIM

### Problem 3: "Connection timeout"

**Solusi:**

- Pastikan koneksi internet stabil
- Coba ganti port:
    - Port 587 (TLS) - recommended
    - Port 465 (SSL)

```env
# Untuk port 465, gunakan:
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

### Problem 4: Email tetap tidak terkirim

**Solusi:**

1. Cek log Laravel:

```bash
tail -f storage/logs/laravel.log
```

2. Test koneksi SMTP:

```bash
php artisan tinker
```

Kemudian di tinker:

```php
Mail::raw('Test email', function($msg) {
    $msg->to('email-tujuan@gmail.com')->subject('Test');
});
```

## 🔒 Keamanan

1. **Jangan commit file .env** ke Git
2. **Jangan share App Password** ke orang lain
3. **Gunakan environment variables** untuk production
4. **Revoke App Password** jika tidak digunakan lagi

## 🚀 Untuk Production

Untuk production, lebih baik gunakan layanan email dedicated seperti:

- **Mailgun** (Free 5000 email/bulan)
- **SendGrid** (Free 100 email/hari)
- **Amazon SES** (Murah, reliable)
- **Mailtrap** (untuk testing)

### Setup Mailgun (Recommended)

1. Daftar di https://www.mailgun.com/
2. Verify domain atau gunakan sandbox domain
3. Update .env:

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-secret-key
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="RS Catering"
```

4. Install package:

```bash
composer require symfony/mailgun-mailer symfony/http-client
```

## ✅ Checklist Setup

- [ ] 2-Step Verification aktif di Gmail
- [ ] App Password sudah dibuat
- [ ] File .env sudah diupdate dengan email dan App Password
- [ ] MAIL_MAILER = smtp
- [ ] MAIL_HOST = smtp.gmail.com
- [ ] MAIL_PORT = 587
- [ ] MAIL_ENCRYPTION = tls
- [ ] Server sudah direstart
- [ ] Test kirim email berhasil

## 📝 Contoh Email yang Akan Dikirim

Ketika user request reset password, Laravel akan mengirim email dengan format:

**Subject:** Reset Password Notification

**Isi:**

```
You are receiving this email because we received a password reset request for your account.

[Reset Password Button]

This password reset link will expire in 60 minutes.

If you did not request a password reset, no further action is required.
```

---

**Dibuat:** 7 Februari 2026
**Update terakhir:** 7 Februari 2026
