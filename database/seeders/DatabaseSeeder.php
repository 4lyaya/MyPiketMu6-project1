<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Akmal Raditya Wijaya',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Guru
        User::create([
            'name' => 'Mahiru Shiina',
            'email' => 'guru@example.com',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ]);

        DB::table('teachers')->insert([
            [
                'name' => 'Ahmad Fauzi',
                'phone' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'phone' => '081234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'phone' => '081234567892',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewi Lestari',
                'phone' => '081234567893',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hendra Wijaya',
                'phone' => '081234567894',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ratna Sari',
                'phone' => '081234567895',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agus Setiawan',
                'phone' => '081234567896',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nur Aini',
                'phone' => '081234567897',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rizky Kurniawan',
                'phone' => '081234567898',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maya Putri',
                'phone' => '081234567899',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Data jurusan
        $majors = ['TKJ', 'RPL', 'LK', 'TPFL', 'TKR', 'TBSM'];
        // Tingkat
        $levels = ['X', 'XI', 'XII'];

        $classrooms = [];

        foreach ($majors as $major) {
            foreach ($levels as $level) {
                for ($i = 1; $i <= 2; $i++) {
                    $classrooms[] = [
                        'name'       => "{$level} {$major} {$i}",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        DB::table('classrooms')->insert($classrooms);
    }
}
