<?php

use App\Person;
use App\User;
use App\UserDetail;
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
        $user = User::create([
            'name' => 'Abdullah Fahmi',
            'email' => 'abdullahfahmi1997@gmail.com',
            'password' => bcrypt('doelmi30')
        ]);

        $person = Person::create([
            'name' => 'Abdullah Fahmi',
            'nickname' => 'Fahmi',
            'education' => 'd4-s1',
            'email' => 'abdullahfahmi1997@gmail.com',
            'phone' => '08123456789',
            'address' => null,
            'province' => null,
            'city' => null,
            'district' => null,
            'village' => null,
            'gender' => 'man',
            'identification_number' => '1234567890123456',
            'birth_place' => null,
            'birth_date' => null,
            'life_status' => 'alive',
            'marital_status' => 'single',
            'father_id' => null,
            'mother_id' => null,
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'people_id' => $person->id,
            'role_id' => 1,
            'status' => 'active'
        ]);
    }
}
