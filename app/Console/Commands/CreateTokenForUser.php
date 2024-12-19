<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateTokenForUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-token-for-user {--user=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a token for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = $this->setUser();

        if(!$user) {
            return;
        }

        $name = $user->name . ' ' . $user->email . ' ' . now();
        $token = $user->createToken($name)->plainTextToken;

        $this->info($token);

        return 0;
    }

    private function setUser(): ?User
    {
        $input = $this->option('user');
       
        if(is_numeric($input)) {
            $user = User::find($input);
        } else {
            $user = User::where('email', $input)->first();
        }

        if(!$user) {
            $this->error('User not found');
            return null;
        }

        return $user;
    }
}
