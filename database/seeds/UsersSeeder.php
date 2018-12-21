<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Users to import.
     *
     * @return  array
     */
    protected function users()
    {
        return [
            [
                'name' => 'Administrator',
                'email' => 'admin@site.com',
                'password' => bcrypt('welcome')
            ]
        ];
    }

    public function run()
    {
        foreach ($this->users() as $user) {
            User::firstOrCreate(array_only($user, ['email']), $user);
        }
    }
}
