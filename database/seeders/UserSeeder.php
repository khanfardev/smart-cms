<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use PharIo\Version\Exception;
use PhpParser\Error;

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
                'email' => 'khanfar@gmail.com',
                'name' => 'mohammad khanfar',
                'password' => bcrypt('123456'),
            ]);
        $user2 = User::create([
            'email' => 'mohammad@gmail.com',
            'name' => 'mohammad khanfar',
            'password' => bcrypt('123456'),
        ]);
        $user2->assignRole('user');
        $user->assignRole('admin');
    }
}
