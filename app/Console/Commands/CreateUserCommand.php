<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Core\Services\Contracts\UserServiceContract as UserService;

class CreateUserCommand extends Command
{

    protected $signature = 'create:user {name?} {email?} {role?} {--password=}';
    protected $description = 'Create user!';
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }

    public function handle()
    {
        $faker = \Faker\Factory::create();
        $user = [
            'name' => $this->argument('name') ?? $faker->name(),
            'email' => $this->argument('email') ?? $faker->email(),
            'password' => $this->option('password') ?? "123456"
        ];
        $role = $this->argument('role') ?? 2;
        $response = $this->userService->createUser($user, $role);
        if(!$response['status']){
            foreach($response['errors']->all() as $errors){
                $this->error($errors);
            }
            return 0;
        }
        $this->info("name : {$user['name']}");
        $this->info("email : {$user['email']}");
        $this->info("password : {$user['password']}");
        return 0;
    }
}
