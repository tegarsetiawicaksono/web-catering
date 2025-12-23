# 🔧 Troubleshooting Riwayat Pesanan

## ✅ Perbaikan yang Sudah Dilakukan

### 1. **Middleware UserMiddleware**
- Sekarang mengizinkan admin untuk akses riwayat pesanan mereka
- Route `orders.*` ditambahkan ke whitelist bersama `profile.*`

### 2. **Database Structure**
- Tabel `orders` sekarang memiliki kolom `user_id`
- Kolom `items` (JSON) untuk menyimpan detail pesanan
- Kolom `payment_status` untuk tracking status pembayaran

### 3. **Order Controller**
- Method `store()` sekarang menyimpan `user_id` otomatis saat user login
- Method `history()` query berdasarkan `user_id` atau `email`

### 4. **Cache Cleared**
- Configuration cache
- Application cache  
- Route cache

---

## 🧪 Cara Testing

### 1. Login sebagai User Biasa
```
1. Buka browser: http://localhost:8000
2. Klik login
3. Login dengan akun user (bukan admin)
4. Klik dropdown profil → "Riwayat Pesanan"
5. Seharusnya tampil halaman riwayat pesanan
```

### 2. Login sebagai Admin
```
1. Login dengan akun admin
2. Klik dropdown profil → "Riwayat Pesanan"
3. Seharusnya tampil halaman riwayat pesanan (tidak redirect ke dashboard)
```

### 3. Membuat Pesanan Baru
```
1. Login dulu (user atau admin)
2. Pilih menu → Tambah ke cart
3. Checkout
4. Isi form pesanan
5. Submit
6. Buka "Riwayat Pesanan"
7. Pesanan baru seharusnya muncul dengan status "Pending"
```

---

## 🐛 Jika Masih Error

### Error: 404 Not Found
**Penyebab**: Route cache mungkin outdated

**Solusi**:
```bash
php artisan route:clear
php artisan route:cache
```

### Error: Unauthorized / Redirect Loop
**Penyebab**: Middleware issue

**Solusi**:
```bash
php artisan cache:clear
php artisan config:clear
```

### Pesanan Tidak Muncul
**Penyebab**: Order dibuat sebelum kolom `user_id` ditambahkan

**Solusi 1** - Update order lama:
```sql
-- Jalankan di MySQL/phpMyAdmin
UPDATE orders 
SET user_id = (SELECT id FROM users WHERE users.email = orders.email LIMIT 1)
WHERE user_id IS NULL;
```

**Solusi 2** - Test dengan pesanan baru:
- Buat pesanan baru setelah login
- Pesanan baru akan otomatis punya `user_id`

---

## 📊 Struktur Tabel Orders

Kolom penting:
- `id` - Primary key
- `user_id` - Foreign key ke users (nullable)
- `customer_name` - Nama customer
- `email` - Email customer
- `phone` - Nomor telepon
- `items` - JSON detail pesanan
- `total_price` - Total harga
- `status` - Status order (pending/confirmed/completed/cancelled)
- `payment_status` - Status pembayaran (pending/verified/paid/failed)
- `event_date` - Tanggal acara
- `created_at` - Tanggal order dibuat

---

## 🔍 Debug Query

Jika ingin lihat query yang dijalankan, tambahkan di OrderController:

```php
public function history()
{
    // Debug query
    \DB::enableQueryLog();
    
    $orders = Order::where(function($query) {
        $query->where('user_id', auth()->id())
              ->orWhere('email', auth()->user()->email);
    })
    ->orderBy('created_at', 'desc')
    ->get();
    
    // Lihat query
    dd(\DB::getQueryLog(), $orders->toArray());
    
    return view('orders.history', compact('orders'));
}
```

---

## ✅ Checklist

- [x] Migration dijalankan (`php artisan migrate`)
- [x] Model Order updated (user_id & items di fillable)
- [x] Controller store() menyimpan user_id
- [x] Controller history() query diperbaiki
- [x] Middleware mengizinkan orders.* untuk admin
- [x] Cache di-clear
- [x] Route di-cache ulang

---

## 📞 Support

Jika masih ada masalah:
1. Cek log Laravel: `storage/logs/laravel.log`
2. Cek browser console untuk error JavaScript
3. Test dengan Incognito/Private browsing
4. Pastikan sudah login sebelum akses riwayat pesanan
