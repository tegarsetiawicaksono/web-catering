# 🚀 Quick Start - Setup Email Otomatis

## Setup Email dalam 2 Menit! ⚡

### Langkah 1: Buat App Password Gmail (1 menit)

1. Buka: https://myaccount.google.com/apppasswords
2. Login dengan Gmail Anda
3. Pilih app: **Mail**
4. Pilih device: **Other** → ketik "Laravel Catering"
5. Klik **Generate**
6. **Copy** password 16 karakter yang muncul

### Langkah 2: Jalankan Setup Otomatis (30 detik)

Buka terminal PowerShell di folder project, lalu jalankan:

```powershell
php artisan email:setup
```

Command ini akan:

- ✅ Menanyakan email Gmail Anda
- ✅ Menanyakan App Password (paste dari Langkah 1)
- ✅ Update file .env otomatis
- ✅ Test pengiriman email
- ✅ Selesai! 🎉

### Contoh Interaksi:

```
╔═══════════════════════════════════════════════════════╗
║        Setup Email Konfigurasi untuk Gmail           ║
╚═══════════════════════════════════════════════════════╝

📋 Langkah-langkah mendapatkan App Password Gmail:
   1. Buka: https://myaccount.google.com/security
   2. Aktifkan 2-Step Verification (jika belum)
   3. Cari "App passwords" atau "Sandi aplikasi"
   4. Pilih app: Mail, device: Other
   5. Generate dan copy password 16 karakter

Apakah Anda sudah memiliki App Password Gmail? (yes/no) [no]:
> yes

Masukkan email Gmail Anda [hello@example.com]:
> your-email@gmail.com

Masukkan App Password (16 karakter):
> xxxx xxxx xxxx xxxx

Nama pengirim email [RS Catering]:
> RS Catering

⚙️  Mengupdate konfigurasi email...

✅ Konfigurasi email berhasil diupdate!

Apakah Anda ingin mengirim test email? (yes/no) [yes]:
> yes

Kirim test email ke [your-email@gmail.com]:
> your-email@gmail.com

✅ Test email berhasil dikirim!
📧 Cek inbox atau folder spam Anda!
```

---

## 🧪 Test Email Kapan Saja

Untuk test apakah email masih berfungsi:

```bash
# Test ke email default
php artisan email:test

# Test ke email tertentu
php artisan email:test someone@example.com
```

---

## ❓ Troubleshooting

### "Authentication failed"

❌ **Masalah:** App Password salah atau 2-Step Verification belum aktif

✅ **Solusi:**

```bash
# Setup ulang dengan App Password baru
php artisan email:setup
```

### Email tidak terkirim

❌ **Masalah:** Konfigurasi belum ter-load

✅ **Solusi:**

```bash
# Clear cache dan test lagi
php artisan config:clear
php artisan email:test
```

### Ingin ganti email

✅ **Solusi:**

```bash
# Jalankan setup lagi, akan override konfigurasi lama
php artisan email:setup
```

---

## 📝 Manual Setup (Opsional)

Jika tidak ingin pakai command otomatis, edit manual file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password-16-char
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="RS Catering"
```

Lalu clear cache:

```bash
php artisan config:clear
```

---

## ✅ Checklist

- [ ] Buka https://myaccount.google.com/apppasswords
- [ ] Generate App Password baru
- [ ] Jalankan `php artisan email:setup`
- [ ] Input email dan App Password
- [ ] Test email berhasil terkirim
- [ ] Coba fitur Lupa Password di website

---

**Butuh bantuan?** Lihat dokumentasi lengkap di [EMAIL_SETUP_GUIDE.md](EMAIL_SETUP_GUIDE.md)
