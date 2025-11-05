<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's database with a default admin user.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', '1@admin.com');
        $password = env('ADMIN_PASSWORD', '123');
        $forceReset = filter_var(env('ADMIN_FORCE_RESET', false), FILTER_VALIDATE_BOOLEAN);

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin',
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );

        if (!$user->wasRecentlyCreated) {
            $user->is_admin = true;
            if ($user->name !== 'Admin') {
                $user->name = 'Admin';
            }
            if ($forceReset) {
                $user->password = Hash::make($password);
            }
            $user->save();
        }

        $this->command?->info("Admin user available: {$email}");
    }
}

