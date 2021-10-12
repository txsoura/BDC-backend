<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $users = collect($this->users());

        foreach ($users as $user) {
            User::firstOrCreate($user);
        }

        if (App::environment('local')) {
            User::factory(1)->create();
        }
    }

    public function users(): array
    {
        return [
            [
                'name' => 'BDC Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'status' => UserStatus::APPROVED,
                'role' => UserRole::ADMIN
            ],
            [
                'name' => 'BDC User',
                'email' => 'user@admin.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'status' => UserStatus::APPROVED,
                'role' => UserRole::USER
            ],
        ];
    }
}
