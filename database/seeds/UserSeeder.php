<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username' => 'masteradmin',
            'nama' => 'Master Admin SI-Tan',
            'email' => 'admin.sitan@gmail.com',
            'telp' => '08123456789',
            'password' => bcrypt('admin123'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'username' => 'masterkaryawan',
            'nama' => 'Master Karyawan SI-Tan',
            'email' => 'karyawan.sitan@gmail.com',
            'telp' => '08123456789',
            'password' => bcrypt('karyawan123'),
        ]);

        $user->assignRole('karyawan');
    }
}
