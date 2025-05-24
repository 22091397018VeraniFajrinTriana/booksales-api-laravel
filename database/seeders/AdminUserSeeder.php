<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah tabel users ada dan memiliki kolom role
        if (!Schema::hasTable('users')) {
            $this->command->error('Table users tidak ditemukan! Jalankan migration dulu.');
            return;
        }

        if (!Schema::hasColumn('users', 'role')) {
            $this->command->error('Kolom role tidak ditemukan di tabel users! Jalankan migration add_role_to_users_table dulu.');
            return;
        }

        // Buat user admin default menggunakan DB facade
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat user biasa untuk testing
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@bookstore.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@bookstore.com');
        $this->command->info('Password: password123');
        $this->command->info('');
        $this->command->info('Regular user created successfully!');
        $this->command->info('Email: user@bookstore.com');
        $this->command->info('Password: password123');
    }
}
