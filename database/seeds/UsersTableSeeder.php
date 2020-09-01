<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = new User;
        $user->name = 'Miguel';
        $user->email = 'mfigaredo@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = bcrypt('test123');
        $user->remember_token = Str::random(32);
        $user->save();
    }
}
