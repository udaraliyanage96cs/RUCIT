<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // ── Create user ───────────────────────────────────────────────────────
        $user = User::firstOrCreate([
            'name'     => "Admin",
            'email'    => "admin@sample.com",
            'password' => Hash::make("admin123"),
            'role'     => 'admin',
        ]);

        $this->info("Admin user created successfully!");
        $this->table(
            ['ID', 'Name', 'Email', 'Role'],
            [[$user->id, $user->name, $user->email, $user->role]]
        );

        return self::SUCCESS;
    }
}
