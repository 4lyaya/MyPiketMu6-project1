<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Absence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        User::insert([
            [
                'name'     => 'Akmal Raditya Wijaya',
                'email'    => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'     => 'Mahiru Shiina',
                'email'    => 'guru@example.com',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Teachers
        $teachers = [
            ['name' => 'Ahmad Fauzi',      'phone' => '081234567890'],
            ['name' => 'Siti Nurhaliza',   'phone' => '081234567891'],
            ['name' => 'Budi Santoso',     'phone' => '081234567892'],
            ['name' => 'Dewi Lestari',     'phone' => '081234567893'],
            ['name' => 'Hendra Wijaya',    'phone' => '081234567894'],
            ['name' => 'Ratna Sari',       'phone' => '081234567895'],
            ['name' => 'Agus Setiawan',    'phone' => '081234567896'],
            ['name' => 'Nur Aini',         'phone' => '081234567897'],
            ['name' => 'Rizky Kurniawan',  'phone' => '081234567898'],
            ['name' => 'Maya Putri',       'phone' => '081234567899'],
        ];
        foreach ($teachers as $t) Teacher::create($t);

        // 3. Classrooms
        $majors = ['TKJ', 'RPL', 'LK', 'TPFL', 'TKR', 'TBSM'];
        $levels = ['X', 'XI', 'XII'];
        foreach ($majors as $major) {
            foreach ($levels as $level) {
                for ($i = 1; $i <= 2; $i++) {
                    Classroom::create(['name' => "{$level} {$major} {$i}"]);
                }
            }
        }

        // 4. Absences (20 dummy)
        $teacherIds = Teacher::pluck('id');
        $classIds   = Classroom::pluck('id');
        $reasons    = ['sakit', 'alpha', 'izin', 'terlambat', 'tugas_sekolah'];

        foreach (range(1, 20) as $i) {
            $absent = $teacherIds->random();
            $subst  = $teacherIds->whereNotIn('id', [$absent])->random();
            Classroom::find($classIds->random())->absences()->create([
                'absent_teacher_id'     => $absent,
                'substitute_teacher_id' => $subst,
                'replaced_at'           => Carbon::now()->subDays(rand(0, 30)),
                'periods_mask'          => rand(1, 127),
                'reason'                => $reasons[array_rand($reasons)],
                'note'                  => fake()->sentence(),
                'created_at'            => Carbon::now()->subDays(rand(0, 30)),
                'updated_at'            => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
