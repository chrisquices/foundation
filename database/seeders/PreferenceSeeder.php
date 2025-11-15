<?php

namespace Database\Seeders;

use App\Models\Preference;
use App\Models\User;
use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $preference = new Preference;
            $preference->user_id = $user->id;
            $preference->theme = 'light';
            $preference->save();
        }
    }
}
