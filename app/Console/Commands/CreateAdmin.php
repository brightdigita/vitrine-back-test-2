<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vitrine:admin {name?} {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new vitrine admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name =  $this->argument('name') ?? $this->ask('What is your name?', 'admin');
        $email =  $this->argument('email') ?? $this->ask('What is your email?', 'admin@admin.com');
        $password =  $this->argument('password') ?? $this->secret('What is the password?');

        try {
            $this->call('orchid:admin', [
                'name' => $name,
                'password' => $password,
                'email' => $email,
            ]);
        } catch (Exception | QueryException $e) {
            $this->error($e->getMessage());
        }
    }
}
