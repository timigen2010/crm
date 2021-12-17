<?php

namespace App\Console\Commands\User;

use App\Model\User\Service\RegisterUser\RegisterUserInterface;
use App\Model\User\Service\RegisterUser\RegisterService\Data;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisterUserCommand extends Command
{
    protected $signature = "app:user:register {username} {password} {user_group_id} {hide_phone} {status}";

    protected $description = 'Create user';

    private $registerUser;

    public function __construct(RegisterUserInterface $registerUser)
    {
        parent::__construct();
        $this->registerUser = $registerUser;
    }

    public function handle()
    {
        try {
            $user = $this->registerUser->register(new Data(
                $this->argument('user_group_id'),
                $this->argument('username'),
                $this->argument('password'),
                $this->argument('hide_phone'),
                $this->argument('status')
            ));
            $this->info("User created with id #{$user->user_id}");
        } catch (ModelNotFoundException $e) {
            $this->error("Model not found: " . $e->getMessage());
        } catch (\Throwable $e) {
            $this->error("Exception: " . $e->getMessage());
        }
    }
}
