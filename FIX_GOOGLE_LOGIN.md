# 🔧 Cara Mengatasi Error "Access blocked: Authorization Error"

## ⚡ Solusi Cepat (Pilih Salah Satu)

### Opsi 1: Tambahkan Email Sebagai Test User (RECOMMENDED untuk Development)

1. Buka https://console.cloud.google.com/
2. Pilih project Anda
3. Klik menu **APIs & Services** → **OAuth consent screen**
4. Scroll ke bawah sampai bagian **Test users**
5. Klik tombol **+ ADD USERS**
6. Masukkan email Gmail yang akan digunakan login (email Anda)
7. Klik **SAVE**
8. Coba login lagi ✅

### Opsi 2: Publish App (Hanya untuk Production)

1. Buka https://console.cloud.google.com/
2. Pilih project Anda
3. Klik menu **APIs & Services** → **OAuth consent screen**
4. Klik tombol **PUBLISH APP**
5. Konfirmasi
6. Sekarang semua user bisa login ✅

---

## 📋 Checklist Konfigurasi Lengkap

Pastikan semua langkah ini sudah dilakukan:

### Step 1: OAuth Consent Screen
- [ ] OAuth consent screen sudah dikonfigurasi
- [ ] App name sudah diisi: "Rejosari Catering"
- [ ] User support email sudah diisi
- [ ] Developer contact email sudah diisi
- [ ] Scopes sudah ditambahkan:
  - [ ] userinfo.email
  - [ ] userinfo.profile  
  - [ ] openid
- [ ] **Test users sudah ditambahkan** (email Gmail Anda) ← PENTING!

### Step 2: Credentials
- [ ] OAuth Client ID sudah dibuat
- [ ] Client ID sudah dicopy
- [ ] Client Secret sudah dicopy
- [ ] Authorized redirect URIs sudah ditambahkan:
  - [ ] `http://localhost:8000/auth/google/callback`
  - [ ] `http://localhost/auth/google/callback` (jika pakai Laragon)

### Step 3: File .env
- [ ] `GOOGLE_CLIENT_ID` sudah diisi dengan nilai yang benar
- [ ] `GOOGLE_CLIENT_SECRET` sudah diisi dengan nilai yang benar
- [ ] `GOOGLE_REDIRECT` sudah diisi: `http://localhost:8000/auth/google/callback`
- [ ] Cache sudah di-clear: `php artisan config:clear`

---

## 🎯 Langkah-langkah Detail

### 1. Konfigurasi OAuth Consent Screen (WAJIB!)

Jika belum pernah setup:

1. Buka: https://console.cloud.google.com/apis/credentials/consent
2. Pilih **External** (untuk publik)
3. Klik **CREATE**
4. Isi form:
   ```
   App name: Rejosari Catering
   User support email: [email Anda]
   Developer contact email: [email Anda]
   ```
5. Klik **SAVE AND CONTINUE**
6. Di halaman Scopes, klik **ADD OR REMOVE SCOPES**
7. Cari dan centang:
   - `.../auth/userinfo.email`
   - `.../auth/userinfo.profile`
   - `openid`
8. Klik **UPDATE** → **SAVE AND CONTINUE**
9. Di halaman **Test users**, klik **+ ADD USERS**
10. Masukkan email Gmail Anda (yang akan dipakai login)
11. Klik **SAVE**
12. **SAVE AND CONTINUE** → **BACK TO DASHBOARD**

### 2. Buat OAuth Client ID

1. Buka: https://console.cloud.google.com/apis/credentials
2. Klik **+ CREATE CREDENTIALS** → **OAuth client ID**
3. Application type: **Web application**
4. Name: `Rejosari Catering Web`
5. Authorized redirect URIs, klik **+ ADD URI**:
   - Tambahkan: `http://localhost:8000/auth/google/callback`
   - Tambahkan: `http://localhost/auth/google/callback`
6. Klik **CREATE**
7. **COPY** Client ID dan Client Secret

### 3. Update .env

Buka file `.env` di root project, cari dan update:

```env
GOOGLE_CLIENT_ID=1234567890-abc123xyz.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-your_secret_key_here
GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback
```

**Untuk Laragon:**
```env
GOOGLE_REDIRECT=http://localhost/auth/google/callback
```

### 4. Clear Cache

Jalankan di terminal:
```bash
php artisan config:clear
php artisan cache:clear
```

### 5. Testing

1. Buka browser
2. Akses halaman login aplikasi
3. Klik "Login dengan Google"
4. **Pilih email yang sudah ditambahkan sebagai Test User**
5. Klik "Continue" atau "Allow"
6. Done! ✅

---

## ❓ FAQ

**Q: Kenapa masih error "Access blocked" padahal sudah setup?**
A: Pastikan email yang digunakan login sudah ditambahkan di Test users

**Q: Berapa lama perubahan diterapkan?**
A: Instant, tidak perlu menunggu

**Q: Bisa menggunakan email domain sendiri (bukan Gmail)?**
A: Bisa, tapi harus setup Google Workspace dulu

**Q: App harus di-publish?**
A: Tidak wajib untuk development, cukup tambahkan sebagai Test user

**Q: Maksimal berapa Test users?**
A: 100 test users untuk aplikasi dalam mode Testing

---

## 🆘 Masih Error?

Cek file `GOOGLE_OAUTH_SETUP.md` untuk troubleshooting lengkap atau hubungi developer.