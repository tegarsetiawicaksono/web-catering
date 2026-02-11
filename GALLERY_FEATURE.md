# Gallery Management - Fitur CRUD Galeri Foto

## Deskripsi

Fitur CRUD (Create, Read, Update, Delete) untuk mengelola galeri foto pada dashboard admin. Admin dapat menambah, mengedit, dan menghapus foto untuk setiap kategori menu (Buffet, Tumpeng, Nasi Box, dan Snack).

## Fitur Utama

### 1. **Halaman Index Galeri**

- Menampilkan semua foto dalam grid layout yang responsive
- Filter foto berdasarkan kategori
- Badge warna berbeda untuk setiap kategori:
    - 🔵 Buffet - Biru
    - 🟢 Tumpeng - Hijau
    - 🟡 Nasi Box - Kuning
    - 🩷 Snack - Pink
- Pagination untuk navigasi foto
- Preview foto dengan hover effect
- Action buttons (Edit & Hapus)

### 2. **Tambah Foto Baru**

- Upload foto dengan drag & drop atau click to browse
- Preview gambar sebelum upload
- Pilihan kategori: Buffet, Tumpeng, Nasi Box, Snack
- Caption/deskripsi (opsional)
- Validasi:
    - Format: JPEG, PNG, JPG, GIF, WEBP
    - Ukuran maksimal: 2MB
    - Kategori wajib dipilih

### 3. **Edit Foto**

- Lihat foto saat ini
- Ubah kategori
- Ganti foto (opsional) - jika tidak diganti, foto lama tetap digunakan
- Update caption/deskripsi
- Preview foto baru sebelum upload

### 4. **Hapus Foto**

- Konfirmasi sebelum menghapus
- File foto otomatis terhapus dari storage
- Feedback sukses setelah penghapusan

## Akses & Route

### Navigasi

Menu "Galeri Foto" tersedia di sidebar admin dashboard dengan icon gambar.

### Routes

```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('gallery', GalleryController::class);
});
```

### URL Routes:

- **Index**: `/admin/gallery` - Daftar semua foto
- **Create**: `/admin/gallery/create` - Form tambah foto baru
- **Edit**: `/admin/gallery/{id}/edit` - Form edit foto
- **Delete**: `/admin/gallery/{id}` - Hapus foto (POST method DELETE)

## Struktur Database

### Tabel: `galleries`

| Column     | Type              | Description                               |
| ---------- | ----------------- | ----------------------------------------- |
| id         | bigint            | Primary key                               |
| category   | enum              | Kategori: buffet, tumpeng, nasibox, snack |
| path       | string            | Path file foto di storage                 |
| caption    | string (nullable) | Caption/deskripsi foto                    |
| created_at | timestamp         | Waktu dibuat                              |
| updated_at | timestamp         | Waktu diupdate                            |

## Model Methods

### Gallery Model

```php
// Get full URL image
$gallery->image_url;

// Get formatted category name
$gallery->category_name; // Output: "Buffet", "Tumpeng", dll
```

## Controller Methods

### GalleryController

- `index(Request $request)` - Menampilkan daftar foto dengan filter kategori
- `create()` - Form tambah foto baru
- `store(Request $request)` - Simpan foto baru
- `edit(Gallery $gallery)` - Form edit foto
- `update(Request $request, Gallery $gallery)` - Update foto
- `destroy(Gallery $gallery)` - Hapus foto

## Storage

Foto disimpan di: `storage/app/public/foto/galeri/`

Pastikan storage link sudah dibuat:

```bash
php artisan storage:link
```

## Validasi Upload

### Rules:

```php
'category' => 'required|in:buffet,tumpeng,nasibox,snack',
'caption' => 'nullable|string|max:255',
'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
```

## Screenshots & UI

### Grid Layout

- Responsive grid: 1 kolom (mobile), 2 kolom (tablet), 3-4 kolom (desktop)
- Aspect ratio 16:9 untuk konsistensi
- Hover effect dengan scale image
- Badge kategori di pojok kanan atas

### Empty State

Jika belum ada foto, tampil:

- Icon placeholder
- Pesan "Belum Ada Foto"
- Tombol "Tambah Foto"

## Testing

Untuk testing fitur ini:

1. Login sebagai admin
2. Akses `/admin/gallery`
3. Tambah foto baru untuk setiap kategori
4. Coba filter berdasarkan kategori
5. Edit foto dan ganti kategori
6. Hapus foto dan pastikan file terhapus

## Seeder

Jalankan seeder untuk data contoh:

```bash
php artisan db:seed --class=GallerySeeder
```

**Note**: Seeder akan membuat 8 data contoh (2 foto per kategori), namun path foto adalah placeholder. Anda perlu upload foto asli melalui admin panel.

## Tips Penggunaan

1. **Optimasi Gambar**: Compress gambar sebelum upload untuk performa lebih baik
2. **Nama File**: Sistem akan auto-generate nama file unik
3. **Caption**: Gunakan caption yang deskriptif untuk SEO
4. **Kategori**: Pastikan memilih kategori yang sesuai agar mudah difilter

## Troubleshooting

### Foto tidak muncul?

- Pastikan `php artisan storage:link` sudah dijalankan
- Cek permission folder `storage/app/public`
- Verifikasi path di database sesuai dengan file di storage

### Upload gagal?

- Cek ukuran file (max 2MB)
- Pastikan format file sesuai (jpeg, png, jpg, gif, webp)
- Cek disk space server

### Error 500 saat upload?

- Cek permission folder storage
- Pastikan `public` disk sudah dikonfigurasi di `config/filesystems.php`

## Future Improvements

Beberapa enhancement yang bisa ditambahkan:

- [ ] Bulk upload multiple images
- [ ] Image cropping sebelum upload
- [ ] Sort/reorder galeri (drag & drop)
- [ ] Gallery frontend untuk customer
- [ ] Lightbox untuk preview full image
- [ ] Export gallery ke PDF/ZIP
- [ ] Image optimization otomatis (resize, compress)
- [ ] Tags/labels untuk organisasi lebih baik
