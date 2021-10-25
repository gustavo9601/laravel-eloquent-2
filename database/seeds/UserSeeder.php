<?php

use App\User;
use App\UserProfile;
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

        // User with options
        factory(User::class)->create([
            'name' => 'Gustavo Marquez',
            'email' => 'duilissso@styde.net',
            'password' => bcrypt('password'),
            'options' => [
                'language' => 'es',
                'theme' => 'dark',
            ],
            'role' => 'admin',
            'api_token' => 'admin-test-token'
        ]);


        factory(User::class)->create([
            'name' => 'Gustavo sssMarquez',
            'email' => 'duilissasso@styde.net',
            'password' => bcrypt('password'),
            'options' => [
                'language' => 'es',
                'theme' => 'dark',
            ],
            'role' => 'user',
            'api_token' => 'user-test-token'
        ]);

        // Users with profile
        factory(User::class)->times(10)->create()->each(function ($user) {
            factory(UserProfile::class)->create([
                'user_id' => $user->id,
            ]);
        });


        // Users without profile
        factory(User::class)->times(10)->create();
    }
}
