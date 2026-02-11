# 🍽️ Web Catering - Laravel Application

Aplikasi web catering untuk pemesanan paket buffet, tumpeng, nasi box, dan snack.

## ✨ Fitur

- 🔐 Autentikasi (Login/Register dengan Email & Google OAuth)
- 🛒 Shopping Cart
- 📦 Manajemen Pesanan
- 👤 Profile Management
- 🔑 Reset Password via Email
- 📱 Responsive Design
- 💳 Payment Verification

## 🚀 Quick Start

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Setup Database

```bash
php artisan migrate
php artisan db:seed
```

### 4. Setup Email (PENTING!)

Untuk fitur reset password, Anda perlu setup email Gmail:

```bash
php artisan email:setup
```

Command ini akan memandu Anda step-by-step untuk:

- Input email Gmail
- Input App Password Gmail
- Konfigurasi otomatis
- Test pengiriman email

**Atau setup manual di file `.env`:**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="RS Catering"
```

📖 **Panduan lengkap:** [EMAIL_SETUP_GUIDE.md](EMAIL_SETUP_GUIDE.md)

### 5. Run Application

```bash
# Terminal 1 - Laravel Server
php artisan serve

# Terminal 2 - Vite Dev Server
npm run dev
```

Buka: http://localhost:8000

## 🛠️ Artisan Commands

### Email Commands

```bash
# Setup email Gmail (interactive)
php artisan email:setup

# Test pengiriman email
php artisan email:test

# Test ke email tertentu
php artisan email:test user@example.com
```

### Cache Commands

```bash
# Clear all cache
php artisan optimize:clear

# Clear config cache
php artisan config:clear

# Clear view cache
php artisan view:clear
```

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Gmail Account (untuk email notifications)

## 🔧 Configuration

### Google OAuth Setup

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih existing
3. Enable Google+ API
4. Buat OAuth 2.0 credentials
5. Update `.env`:

```env
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback
```

📖 **Panduan lengkap:** [GOOGLE_OAUTH_SETUP.md](GOOGLE_OAUTH_SETUP.md)

## 📁 Project Structure

```
app/
├── Console/Commands/
│   ├── SetupEmail.php      # Email setup command
│   └── TestEmail.php        # Email test command
├── Http/Controllers/
├── Models/
└── ...
resources/
├── js/
│   └── cart-store.js       # Alpine.js cart store
└── views/
    ├── auth/               # Login, register, forgot password
    ├── profile/            # User profile & settings
    └── ...
routes/
└── web.php                # All routes
```

## 🎨 Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade, Alpine.js, Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Breeze + Google OAuth
- **Email:** SMTP (Gmail)

## 📧 Email Features

- ✅ Password Reset
- ✅ Email Verification (optional)
- ✅ Order Notifications
- ✅ Custom templates

## 🐛 Troubleshooting

### Email tidak terkirim?

```bash
# 1. Cek konfigurasi
php artisan config:clear
php artisan email:test

# 2. Cek log
tail -f storage/logs/laravel.log

# 3. Setup ulang
php artisan email:setup
```

### Error "Class not found"?

```bash
composer dump-autoload
php artisan optimize:clear
```

### CSS tidak muncul?

```bash
npm run build
# atau
npm run dev
```

## 📝 Development

```bash
# Run with hot reload
npm run dev

# Build for production
npm run build

# Run tests
php artisan test
```

## 🤝 Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
