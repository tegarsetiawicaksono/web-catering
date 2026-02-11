<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup email configuration for Gmail SMTP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('');
        $this->info('╔═══════════════════════════════════════════════════════╗');
        $this->info('║        Setup Email Konfigurasi untuk Gmail           ║');
        $this->info('╚═══════════════════════════════════════════════════════╝');
        $this->info('');

        // Tampilkan instruksi
        $this->warn('📋 Langkah-langkah mendapatkan App Password Gmail:');
        $this->line('   1. Buka: https://myaccount.google.com/security');
        $this->line('   2. Aktifkan 2-Step Verification (jika belum)');
        $this->line('   3. Cari "App passwords" atau "Sandi aplikasi"');
        $this->line('   4. Pilih app: Mail, device: Other');
        $this->line('   5. Generate dan copy password 16 karakter');
        $this->info('');

        // Tanya apakah sudah punya App Password
        if (!$this->confirm('Apakah Anda sudah memiliki App Password Gmail?', false)) {
            $this->error('');
            $this->error('❌ Silakan buat App Password terlebih dahulu.');
            $this->warn('   Buka: https://myaccount.google.com/apppasswords');
            $this->info('');
            return 1;
        }

        $this->info('');

        // Input email
        $email = $this->ask('Masukkan email Gmail Anda', config('mail.from.address'));
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('❌ Email tidak valid!');
            return 1;
        }

        // Input App Password
        $password = $this->secret('Masukkan App Password (16 karakter)');
        
        if (empty($password)) {
            $this->error('❌ Password tidak boleh kosong!');
            return 1;
        }

        // Hapus spasi dan dash dari password
        $password = str_replace([' ', '-'], '', $password);

        // Input nama pengirim
        $fromName = $this->ask('Nama pengirim email', 'RS Catering');

        $this->info('');
        $this->info('⚙️  Mengupdate konfigurasi email...');

        // Update .env file
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        // Update konfigurasi
        $replacements = [
            'MAIL_MAILER=log' => 'MAIL_MAILER=smtp',
            'MAIL_MAILER=smtp' => 'MAIL_MAILER=smtp',
            'MAIL_HOST=127.0.0.1' => 'MAIL_HOST=smtp.gmail.com',
            'MAIL_HOST=smtp.gmail.com' => 'MAIL_HOST=smtp.gmail.com',
            'MAIL_PORT=2525' => 'MAIL_PORT=587',
            'MAIL_PORT=587' => 'MAIL_PORT=587',
            'MAIL_USERNAME=null' => "MAIL_USERNAME={$email}",
            'MAIL_USERNAME=your-email@gmail.com' => "MAIL_USERNAME={$email}",
            '/MAIL_USERNAME=.*/' => "MAIL_USERNAME={$email}",
            'MAIL_PASSWORD=null' => "MAIL_PASSWORD={$password}",
            'MAIL_PASSWORD=your-app-password' => "MAIL_PASSWORD={$password}",
            '/MAIL_PASSWORD=.*/' => "MAIL_PASSWORD={$password}",
            'MAIL_FROM_ADDRESS="hello@example.com"' => "MAIL_FROM_ADDRESS=\"{$email}\"",
            'MAIL_FROM_ADDRESS="your-email@gmail.com"' => "MAIL_FROM_ADDRESS=\"{$email}\"",
            '/MAIL_FROM_ADDRESS=.*/' => "MAIL_FROM_ADDRESS=\"{$email}\"",
        ];

        // Tambahkan MAIL_ENCRYPTION jika belum ada
        if (!str_contains($envContent, 'MAIL_ENCRYPTION=')) {
            $envContent = preg_replace(
                '/MAIL_PASSWORD=.*\n/',
                "MAIL_PASSWORD={$password}\nMAIL_ENCRYPTION=tls\n",
                $envContent
            );
        } else {
            $envContent = preg_replace(
                '/MAIL_ENCRYPTION=.*/',
                'MAIL_ENCRYPTION=tls',
                $envContent
            );
        }

        // Update semua konfigurasi
        $envContent = preg_replace('/MAIL_MAILER=.*/', 'MAIL_MAILER=smtp', $envContent);
        $envContent = preg_replace('/MAIL_HOST=.*/', 'MAIL_HOST=smtp.gmail.com', $envContent);
        $envContent = preg_replace('/MAIL_PORT=.*/', 'MAIL_PORT=587', $envContent);
        $envContent = preg_replace('/MAIL_USERNAME=.*/', "MAIL_USERNAME={$email}", $envContent);
        $envContent = preg_replace('/MAIL_PASSWORD=.*/', "MAIL_PASSWORD={$password}", $envContent);
        $envContent = preg_replace('/MAIL_FROM_ADDRESS=.*/', "MAIL_FROM_ADDRESS=\"{$email}\"", $envContent);
        $envContent = preg_replace('/MAIL_FROM_NAME=.*/', "MAIL_FROM_NAME=\"{$fromName}\"", $envContent);

        // Simpan file .env
        file_put_contents($envPath, $envContent);

        // Clear cache
        $this->call('config:clear');

        $this->info('');
        $this->info('✅ Konfigurasi email berhasil diupdate!');
        $this->info('');
        $this->table(
            ['Setting', 'Value'],
            [
                ['MAIL_MAILER', 'smtp'],
                ['MAIL_HOST', 'smtp.gmail.com'],
                ['MAIL_PORT', '587'],
                ['MAIL_ENCRYPTION', 'tls'],
                ['MAIL_USERNAME', $email],
                ['MAIL_PASSWORD', str_repeat('*', strlen($password))],
                ['MAIL_FROM_ADDRESS', $email],
                ['MAIL_FROM_NAME', $fromName],
            ]
        );

        $this->info('');
        
        // Tanya apakah ingin test email
        if ($this->confirm('Apakah Anda ingin mengirim test email?', true)) {
            $this->info('');
            $testEmail = $this->ask('Kirim test email ke', $email);
            
            try {
                \Mail::raw('Ini adalah test email dari Laravel Catering App. Konfigurasi email berhasil! ✅', function($message) use ($testEmail) {
                    $message->to($testEmail)
                            ->subject('Test Email - Laravel Catering');
                });
                
                $this->info('');
                $this->info('✅ Test email berhasil dikirim ke ' . $testEmail);
                $this->warn('📧 Cek inbox atau folder spam Anda!');
            } catch (\Exception $e) {
                $this->error('');
                $this->error('❌ Gagal mengirim test email!');
                $this->error('Error: ' . $e->getMessage());
                $this->info('');
                $this->warn('💡 Tips:');
                $this->line('   - Pastikan App Password benar');
                $this->line('   - Pastikan 2-Step Verification aktif');
                $this->line('   - Cek koneksi internet');
                $this->line('   - Coba buat App Password baru');
            }
        }

        $this->info('');
        $this->info('🎉 Setup selesai! Server akan restart otomatis jika menggunakan artisan serve.');
        $this->info('');

        return 0;
    }
}
