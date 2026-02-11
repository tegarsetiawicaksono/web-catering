<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class GenerateResetLink extends Command
{
    protected $signature = 'password:reset-link {email}';
    protected $description = 'Generate password reset link untuk email tertentu';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info('');
        $this->info('🔍 Mencari user dengan email: ' . $email);
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error('');
            $this->error('❌ Email tidak ditemukan di database!');
            $this->info('');
            $this->warn('💡 Daftar email yang terdaftar:');
            
            $users = User::select('email', 'name')->get();
            if ($users->count() > 0) {
                $this->table(['Email', 'Nama'], $users->map(fn($u) => [$u->email, $u->name]));
            } else {
                $this->line('   (Belum ada user terdaftar)');
            }
            
            $this->info('');
            return 1;
        }
        
        $this->info('✅ User ditemukan: ' . $user->name);
        $this->info('');
        $this->info('📤 Mengirim reset link...');
        
        $token = Password::broker()->createToken($user);
        $resetUrl = url('reset-password/' . $token . '?email=' . urlencode($email));
        
        $this->info('');
        $this->info('✅ Reset link berhasil dibuat!');
        $this->info('');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->warn('🔗 COPY LINK INI:');
        $this->info('');
        $this->line($resetUrl);
        $this->info('');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('');
        $this->warn('📋 Cara pakai:');
        $this->line('   1. Copy link di atas');
        $this->line('   2. Paste di browser');
        $this->line('   3. Masukkan password baru');
        $this->line('   4. Selesai!');
        $this->info('');
        
        return 0;
    }
}
