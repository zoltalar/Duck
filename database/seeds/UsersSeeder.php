<?php

use App\User;
use Illuminate\Database\Seeder;

final class UsersSeeder extends Seeder
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
                'password' => 'welcome',
                'role' => 'admin'
            ]
        ];
    }

    public function run()
    {
        foreach ($this->users() as $data) {
            $user = array_except($data, 'role');
            $model = User::firstOrCreate(array_only($user, ['email']), $user);

            if ($model !== null && isset($data['role'])) {
                $model->assignRole($data['role']);
            }
        }
    }
}
