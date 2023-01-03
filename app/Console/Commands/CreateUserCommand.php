<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Core\Services\Contracts\UserServiceContract;
use Illuminate\Support\Str;

class CreateUserCommand extends Command
{

    protected $signature = 'create:user {name?} {email?} {role?} {--password=}';
    protected $description = 'Create user!';
    protected $userService;

    public function __construct(UserServiceContract $userService)
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
            'password' => $this->option('password') ?? "123456",
            'role_id' => $this->argument('role') ?? 2,
            'remember_token' => Str::random(10),
        ];
        $response = $this->userService->storeUser($user);

        if(!$response['status']){
            foreach($response['messages']->toArray() as $error){
                $this->error($error);
            }
        }
        $this->info("name : {$response->name}");
        $this->info("email : {$response->email}");
        $this->info("password : {$user['password']}");
        return 0;
    }
}
