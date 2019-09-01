<?php
namespace Seeds;

use Illuminate\Database\Seeder;
use App\Models\Setting\Users\User;
use Illuminate\Support\Facades\Hash;

class SystemUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456789),
            'status' => User::$ACTIVE
        ]);

        $user->systemUser()->create(['user_id' => 1]);
    }
}
