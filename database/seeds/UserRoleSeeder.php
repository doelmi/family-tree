<?php

use App\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'code' => 'superadmin',
                'name' => 'Pengelola'
            ],
            [
                'code' => 'admin',
                'name' => 'Pengurus'
            ],
            [
                'code' => 'family_head',
                'name' => 'Kepala Keluarga'
            ],
        ];
        UserRole::insert($roles);
    }
}
