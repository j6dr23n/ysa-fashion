<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        User::insert([
            ['name' => 'NMT', 'email' => 'mrcena1988@gmail.com','password' => bcrypt('password'),'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
