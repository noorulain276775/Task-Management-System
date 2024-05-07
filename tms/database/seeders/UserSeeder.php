<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userObj = new User();
        $userObj->name = 'Noor';
        $userObj->email = 'noor@gmail.com';
        $userObj->password = Hash::make('123456789');
        $userObj->type = 0;
        $userObj->save();

        $adminObj = new User();
        $adminObj->name = 'Admin Noor';
        $adminObj->email = 'adminNoor@gmail.com';
        $adminObj->password = Hash::make('123456789');
        $adminObj->type = 1;
        $adminObj->save();

        $superAdminObj = new User();
        $superAdminObj->name = 'Super Admin Noor';
        $superAdminObj->email = 'superAdminNoor@gmail.com';
        $superAdminObj->password = Hash::make('123456789');
        $superAdminObj->type = 2;
        $superAdminObj->save();

    }
}
