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
            'role' => $this->argument('role') ?? 2,
            'remember_token' => Str::random(10),
        ];
        try {
            $response = $this->userService->createUser($user);
        } catch (\Exception $e) {
            foreach($e->getMessages() as $name => $messages){
                $this->error(implode("\n", $messages));
            }
            exit;
        }
        $this->info("name : {$response->name}");
        $this->info("email : {$response->email}");
        $this->info("password : {$user['password']}");
        return 0;
    }
}
