<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email? : Email tujuan untuk test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test pengiriman email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('');
        $this->info('╔═══════════════════════════════════════════════════════╗');
        $this->info('║              Test Pengiriman Email                    ║');
        $this->info('╚═══════════════════════════════════════════════════════╝');
        $this->info('');

        // Cek konfigurasi email
        $mailer = config('mail.default');
        $host = config('mail.mailers.smtp.host');
        $port = config('mail.mailers.smtp.port');
        $username = config('mail.mailers.smtp.username');

        $this->info('📋 Konfigurasi saat ini:');
        $this->table(
            ['Setting', 'Value'],
            [
                ['MAIL_MAILER', $mailer],
                ['MAIL_HOST', $host],
                ['MAIL_PORT', $port],
                ['MAIL_USERNAME', $username ?: 'Not set'],
            ]
        );
        $this->info('');

        // Validasi konfigurasi
        if ($mailer === 'log') {
            $this->warn('⚠️  Email mailer menggunakan "log" mode.');
            $this->warn('   Email tidak akan dikirim, hanya dicatat di log file.');
            $this->info('');
            
            if ($this->confirm('Apakah Anda ingin setup email sekarang?', true)) {
                $this->call('email:setup');
                return 0;
            }
            return 1;
        }

        if (!$username || $username === 'null' || $username === 'your-email@gmail.com') {
            $this->error('❌ Email belum dikonfigurasi!');
            $this->info('');
            
            if ($this->confirm('Apakah Anda ingin setup email sekarang?', true)) {
                $this->call('email:setup');
                return 0;
            }
            return 1;
        }

        // Get email tujuan
        $toEmail = $this->argument('email');
        
        if (!$toEmail) {
            $toEmail = $this->ask('Kirim test email ke', $username);
        }

        if (!filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
            $this->error('❌ Email tidak valid!');
            return 1;
        }

        $this->info('');
        $this->info('📤 Mengirim test email ke: ' . $toEmail);
        $this->info('⏳ Mohon tunggu...');
        
        try {
            $startTime = microtime(true);
            
            Mail::raw(
                "Halo!\n\n" .
                "Ini adalah test email dari Laravel Catering App.\n\n" .
                "Jika Anda menerima email ini, berarti konfigurasi email sudah benar! ✅\n\n" .
                "Informasi:\n" .
                "- Dikirim dari: " . config('mail.from.address') . "\n" .
                "- Nama pengirim: " . config('mail.from.name') . "\n" .
                "- Server: " . $host . ":" . $port . "\n" .
                "- Waktu: " . now()->format('d/m/Y H:i:s') . "\n\n" .
                "Terima kasih,\n" .
                config('mail.from.name'),
                function($message) use ($toEmail) {
                    $message->to($toEmail)
                            ->subject('✅ Test Email - Laravel Catering App');
                }
            );
            
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime), 2);
            
            $this->info('');
            $this->info('✅ Email berhasil dikirim!');
            $this->info('⏱️  Waktu pengiriman: ' . $duration . ' detik');
            $this->info('');
            $this->warn('📧 Silakan cek inbox atau folder spam di: ' . $toEmail);
            $this->info('');
            
        } catch (\Exception $e) {
            $this->error('');
            $this->error('❌ Gagal mengirim email!');
            $this->error('');
            $this->error('Error: ' . $e->getMessage());
            $this->info('');
            
            $this->warn('💡 Troubleshooting:');
            $this->line('');
            $this->line('1. Pastikan konfigurasi benar:');
            $this->line('   php artisan config:clear');
            $this->line('');
            $this->line('2. Cek file .env:');
            $this->line('   - MAIL_USERNAME harus email Gmail yang valid');
            $this->line('   - MAIL_PASSWORD harus App Password (bukan password Gmail biasa)');
            $this->line('   - MAIL_HOST=smtp.gmail.com');
            $this->line('   - MAIL_PORT=587');
            $this->line('   - MAIL_ENCRYPTION=tls');
            $this->line('');
            $this->line('3. Pastikan 2-Step Verification aktif di Gmail');
            $this->line('');
            $this->line('4. Buat App Password baru:');
            $this->line('   https://myaccount.google.com/apppasswords');
            $this->line('');
            $this->line('5. Cek koneksi internet');
            $this->info('');
            
            if ($this->confirm('Apakah Anda ingin setup ulang email?', false)) {
                $this->info('');
                $this->call('email:setup');
            }
            
            return 1;
        }

        return 0;
    }
}
