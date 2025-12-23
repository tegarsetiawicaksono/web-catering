# Setup Google OAuth untuk Login

## ⚠️ SOLUSI: Error "Access blocked: Authorization Error"

Jika Anda mendapat error **"Access blocked: Authorization Error"**, ikuti langkah berikut:

### Solusi 1: Tambahkan Test Users (Untuk Development)

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Pilih project Anda
3. Pergi ke **APIs & Services** > **OAuth consent screen**
4. Di bagian **Test users**, klik **+ ADD USERS**
5. Masukkan email Gmail yang akan digunakan untuk testing (email Anda sendiri)
6. Klik **Save**
7. Coba login lagi dengan email yang sudah ditambahkan

### Solusi 2: Publish App ke Production (Untuk Production)

**⚠️ PERINGATAN**: Hanya lakukan ini jika aplikasi sudah siap production!

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Pilih project Anda
3. Pergi ke **APIs & Services** > **OAuth consent screen**
4. Klik **PUBLISH APP**
5. Konfirmasi publikasi
6. Aplikasi sekarang bisa diakses oleh semua user dengan Google account

### Solusi 3: Verifikasi Konfigurasi Scope

Pastikan scope yang diminta sudah benar:
- ✅ `openid`
- ✅ `profile`  
- ✅ `email`

---

## Langkah-langkah Setup Google OAuth

### 1. Buat Project di Google Cloud Console

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. Aktifkan **Google+ API** (tidak wajib untuk OAuth dasar)

### 2. Konfigurasi OAuth Consent Screen

**PENTING: Lakukan ini terlebih dahulu sebelum membuat credentials!**

1. Di sidebar, pilih **APIs & Services** > **OAuth consent screen**
2. Pilih **User Type**:
   - **Internal**: Hanya untuk organisasi Google Workspace Anda
   - **External**: Untuk publik (pilih ini untuk development)
3. Klik **Create**
4. Isi form:
   - **App name**: Rejosari Catering
   - **User support email**: email Anda
   - **App logo**: (opsional)
   - **Application home page**: http://localhost:8000
   - **Authorized domains**: (kosongkan untuk localhost)
   - **Developer contact information**: email Anda
5. Klik **Save and Continue**
6. Di **Scopes**, klik **Add or Remove Scopes**:
   - Pilih: `.../auth/userinfo.email`
   - Pilih: `.../auth/userinfo.profile`
   - Pilih: `openid`
7. Klik **Update** → **Save and Continue**
8. Di **Test users**, tambahkan email Gmail Anda untuk testing
9. Klik **Save and Continue**
10. Review dan klik **Back to Dashboard**

### 3. Buat OAuth 2.0 Credentials

1. Di sidebar, pilih **APIs & Services** > **Credentials**
2. Klik **Create Credentials** > **OAuth client ID**
3. Pilih **Application type**: Web application
4. Isi **Name**: Rejosari Catering Web
5. Tambahkan **Authorized JavaScript origins**:
   - `http://localhost:8000`
   - `http://localhost`
6. Tambahkan **Authorized redirect URIs**:
   - Untuk lokal: `http://localhost:8000/auth/google/callback`
   - Untuk lokal (laragon): `http://localhost/auth/google/callback`
   - Untuk production: `https://yourdomain.com/auth/google/callback`
7. Klik **Create**
8. Copy **Client ID** dan **Client Secret** yang muncul

### 4. Update File .env

Buka file `.env` dan update nilai berikut dengan kredensial yang didapat dari Google:

```env
GOOGLE_CLIENT_ID=paste-your-client-id-here
GOOGLE_CLIENT_SECRET=paste-your-client-secret-here
GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback
```

**Untuk Laragon, gunakan:**
```env
GOOGLE_REDIRECT=http://localhost/auth/google/callback
```

### 5. Clear Cache

Setelah update `.env`, jalankan:

```bash
php artisan config:clear
php artisan cache:clear
```

### 6. Testing

1. Buka halaman login
2. Klik tombol "Login dengan Google"
3. Pilih akun Google (pastikan email sudah ditambahkan sebagai Test User)
4. Klik **Continue** atau **Allow**
5. Setelah authorize, akan redirect ke halaman home

---

## Troubleshooting

### ❌ Error: "Access blocked: Authorization Error"
**Penyebab**: Email belum ditambahkan sebagai Test User atau app belum dipublish

**Solusi**:
1. Tambahkan email Anda di **OAuth consent screen** > **Test users**
2. Atau publish app ke production (jika siap)

### ❌ Error: "redirect_uri_mismatch"
**Penyebab**: URL redirect tidak cocok

**Solusi**:
- Pastikan URL di **Authorized redirect URIs** sama persis dengan `GOOGLE_REDIRECT` di `.env`
- Cek juga URL yang diakses (http vs https, localhost vs 127.0.0.1)
- Contoh yang benar:
  ```
  Authorized redirect URI: http://localhost:8000/auth/google/callback
  GOOGLE_REDIRECT: http://localhost:8000/auth/google/callback
  ```

### ❌ Error: "Access blocked: This app's request is invalid"
**Penyebab**: OAuth consent screen belum dikonfigurasi

**Solusi**:
- Lengkapi konfigurasi OAuth consent screen (lihat langkah 2)
- Pastikan scope sudah ditambahkan

### ❌ Error: "invalid_client"
**Penyebab**: Client ID atau Client Secret salah

**Solusi**:
- Periksa kembali nilai `GOOGLE_CLIENT_ID` dan `GOOGLE_CLIENT_SECRET` di `.env`
- Pastikan tidak ada spasi atau karakter tersembunyi
- Jalankan `php artisan config:clear`

### ❌ User tidak bisa login
**Penyebab**: Database atau model issue

**Solusi**:
- Cek tabel `users` di database
- Pastikan kolom `email_verified_at` ter-set untuk user yang login via Google
- Cek log error di `storage/logs/laravel.log`

---

## Checklist Setup

- [ ] Project sudah dibuat di Google Cloud Console
- [ ] OAuth consent screen sudah dikonfigurasi
- [ ] Test users sudah ditambahkan (email Gmail Anda)
- [ ] OAuth Client ID sudah dibuat
- [ ] Client ID dan Client Secret sudah di-copy
- [ ] File `.env` sudah diupdate dengan credentials
- [ ] Redirect URI sudah cocok antara Google Console dan `.env`
- [ ] Cache sudah di-clear (`php artisan config:clear`)
- [ ] Testing dengan email yang sudah ditambahkan sebagai test user

---

## Video Tutorial (Referensi)

Jika masih bingung, cari tutorial YouTube dengan keyword:
- "Laravel Google OAuth setup 2024"
- "Google OAuth consent screen configuration"
- "Fix Access blocked Authorization Error Google OAuth"
