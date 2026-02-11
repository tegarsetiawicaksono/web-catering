<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupMailtrap extends Command
{
    protected $signature = 'email:mailtrap';
    protected $description = 'Setup Mailtrap untuk email testing (MUDAH & GRATIS)';

    public function handle()
    {
        $this->info('');
        $this->info('╔═══════════════════════════════════════════════════════╗');
        $this->info('║     Setup Mailtrap - Email Testing Super Mudah!      ║');
        $this->info('╚═══════════════════════════════════════════════════════╝');
        $this->info('');

        $this->line('Mailtrap adalah layanan email testing:');
        $this->line('✅ GRATIS untuk development');
        $this->line('✅ Tidak perlu App Password ribet');
        $this->line('✅ Semua email tertangkap di inbox Mailtrap');
        $this->line('✅ Tidak ada email yang benar-benar terkirim (aman untuk testing)');
        $this->info('');

        $this->warn('📋 Cara mendapatkan kredensial Mailtrap:');
        $this->line('   1. Buka: https://mailtrap.io/register/signup');
        $this->line('   2. Daftar GRATIS (pakai email atau Google)');
        $this->line('   3. Setelah login, pilih "Email Testing"');
        $this->line('   4. Klik inbox "My Inbox" atau buat inbox baru');
        $this->line('   5. Pilih tab "SMTP Settings"');
        $this->line('   6. Copy username dan password');
        $this->info('');

        if (!$this->confirm('Apakah Anda sudah punya akun Mailtrap?', false)) {
            $this->info('');
            $this->warn('Silakan daftar dulu di: https://mailtrap.io/register/signup');
            $this->line('Gratis, hanya perlu email. Kembali lagi setelah daftar!');
            $this->info('');
            return 1;
        }

        $this->info('');

        // Input credentials
        $username = $this->ask('Masukkan Mailtrap Username (format: 1234567890abcd)');
        $password = $this->secret('Masukkan Mailtrap Password');

        if (empty($username) || empty($password)) {
            $this->error('❌ Username dan password tidak boleh kosong!');
            return 1;
        }

        $this->info('');
        $this->info('⚙️  Mengupdate konfigurasi...');

        // Update .env
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        // Update konfigurasi Mailtrap
        $envContent = preg_replace('/MAIL_MAILER=.*/', 'MAIL_MAILER=smtp', $envContent);
        $envContent = preg_replace('/MAIL_HOST=.*/', 'MAIL_HOST=smtp.mailtrap.io', $envContent);
        $envContent = preg_replace('/MAIL_PORT=.*/', 'MAIL_PORT=2525', $envContent);
        $envContent = preg_replace('/MAIL_USERNAME=.*/', "MAIL_USERNAME={$username}", $envContent);
        $envContent = preg_replace('/MAIL_PASSWORD=.*/', "MAIL_PASSWORD={$password}", $envContent);
        
        // Hapus MAIL_ENCRYPTION atau set ke null
        if (str_contains($envContent, 'MAIL_ENCRYPTION=')) {
            $envContent = preg_replace('/MAIL_ENCRYPTION=.*/', 'MAIL_ENCRYPTION=null', $envContent);
        } else {
            $envContent = preg_replace(
                '/MAIL_PASSWORD=.*\n/',
                "MAIL_PASSWORD={$password}\nMAIL_ENCRYPTION=null\n",
                $envContent
            );
        }

        file_put_contents($envPath, $envContent);

        // Clear cache
        $this->call('config:clear');

        $this->info('');
        $this->info('✅ Konfigurasi Mailtrap berhasil!');
        $this->info('');
        $this->table(
            ['Setting', 'Value'],
            [
                ['MAIL_MAILER', 'smtp'],
                ['MAIL_HOST', 'smtp.mailtrap.io'],
                ['MAIL_PORT', '2525'],
                ['MAIL_USERNAME', $username],
                ['MAIL_PASSWORD', str_repeat('*', strlen($password))],
            ]
        );

        $this->info('');

        // Test email
        if ($this->confirm('Kirim test email sekarang?', true)) {
            $this->info('');
            $this->info('📤 Mengirim test email...');
            
            try {
                \Mail::raw(
                    "Halo!\n\n" .
                    "Test email dari Laravel Catering berhasil! ✅\n\n" .
                    "Email ini tertangkap di Mailtrap Inbox Anda.\n" .
                    "Buka https://mailtrap.io untuk melihatnya.\n\n" .
                    "Sekarang fitur reset password sudah bisa digunakan!",
                    function($message) {
                        $message->to('test@example.com')
                                ->subject('✅ Test Email - Mailtrap Setup Berhasil');
                    }
                );
                
                $this->info('');
                $this->info('✅ Email berhasil dikirim ke Mailtrap!');
                $this->info('');
                $this->warn('📬 Cara melihat email:');
                $this->line('   1. Buka https://mailtrap.io');
                $this->line('   2. Login ke akun Anda');
                $this->line('   3. Buka inbox "My Inbox"');
                $this->line('   4. Anda akan melihat test email di sana!');
                $this->info('');
                
            } catch (\Exception $e) {
                $this->error('');
                $this->error('❌ Gagal mengirim email!');
                $this->error('Error: ' . $e->getMessage());
                $this->info('');
                $this->warn('💡 Pastikan username dan password Mailtrap benar!');
                $this->info('');
                return 1;
            }
        }

        $this->info('🎉 Setup selesai! Sekarang coba fitur reset password.');
        $this->info('📧 Semua email akan tertangkap di Mailtrap inbox.');
        $this->info('');

        return 0;
    }
}
