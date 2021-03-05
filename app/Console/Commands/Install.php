<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vitrine:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Vitrine Backend';

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
        $this->info('Installing vitrine 237 APP');

        $this->info('Migrating data');
        $this->call('migrate:fresh');
        $this->call('rinvex:migrate:subscriptions');
        $this->info('Seeding data');
        $this->call('db:seed');
        $this->info('Indexing data');
        $this->call('tntsearch:import', ["model" => "App\Models\City"]);
        $this->call('tntsearch:import', ["model" => "App\Models\Company"]);
        $this->call('tntsearch:import', ["model" => "App\Models\State"]);
        $this->call('optimize:clear');
        $this->info('Application Installed');
    }
}
