# Auto-Cancel Pesanan Tanpa Pembayaran

## Kebijakan Pembatalan Baru

### 1. **Pesanan yang Sudah Bayar DP**

- ❌ **TIDAK BISA DIBATALKAN** jika sudah upload bukti pembayaran DP
- Status pembayaran apapun (pending, verified, rejected) tetap tidak bisa dibatalkan
- Harus hubungi admin untuk pembatalan darurat

### 2. **Auto-Cancel Otomatis**

- ⏰ Pesanan yang **tidak ada konfirmasi pembayaran selama 3 hari** akan otomatis dibatalkan
- System akan check setiap hari jam 02:00 pagi
- Hanya pesanan dengan status "pending" yang terpengaruh

### 3. **Pembatalan Manual**

- ✅ Bisa dibatalkan jika:
    - Belum ada upload bukti pembayaran
    - Minimal 3 hari sebelum tanggal event
- ❌ Tidak bisa dibatalkan jika:
    - Sudah upload bukti pembayaran (status apapun)
    - Kurang dari 3 hari sebelum event

## Cara Kerja Auto-Cancel

### Command Laravel

```bash
php artisan orders:cancel-unpaid
```

Command ini akan:

1. Cari semua order dengan status "pending"
2. Filter order yang dibuat lebih dari 3 hari yang lalu
3. Check apakah ada payment verification
4. Jika tidak ada payment verification, ubah status menjadi "cancelled"

### Scheduler

Command ini dijalankan otomatis setiap hari jam 02:00 melalui Laravel Scheduler.

**Setup di server:**

```bash
# Tambahkan ke crontab
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

### Testing Manual

```bash
# Test command
php artisan orders:cancel-unpaid

# Test script
php test_auto_cancel.php
```

## File yang Diubah

1. **app/Console/Commands/CancelUnpaidOrders.php** (NEW)
    - Command untuk auto-cancel orders

2. **bootstrap/app.php**
    - Menambahkan scheduler untuk run command setiap hari

3. **resources/views/orders/show.blade.php**
    - Update logika `canCancel`: cek apakah ada payment verification
    - Update teks kebijakan pembatalan
    - Update dialog konfirmasi

4. **app/Http/Controllers/OrderController.php**
    - Update validation: cek apakah ada payment verification (bukan hanya verified)

## Contoh Skenario

### Skenario 1: Order Baru (Hari 1)

```
✅ User buat order
✅ Bisa dibatalkan manual (belum ada DP)
⏰ Punya 3 hari untuk upload bukti pembayaran
```

### Skenario 2: Upload DP (Hari 2)

```
✅ User upload bukti DP
❌ Tidak bisa dibatalkan lagi
✅ Pesanan aman dari auto-cancel
```

### Skenario 3: Tidak Upload DP (Hari 4+)

```
⏰ Sudah 3 hari tidak ada konfirmasi
❌ System otomatis cancel pesanan
📧 (Opsional) Kirim email notifikasi ke customer
```

## Notes

- Auto-cancel hanya berlaku untuk pesanan yang **belum ada payment verification sama sekali**
- Pesanan yang sudah upload DP (status pending/verified/rejected) **aman dari auto-cancel**
- Admin bisa lihat log di `storage/logs/laravel.log` untuk track auto-cancelled orders
