<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;

class TemplateLinkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'template:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "public/template" to "resources/views/template"';

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
     * @return void
     * @throws BindingResolutionException
     */
    public function handle()
    {
        if (file_exists(public_path('template'))) {
            return $this->error('The "public/template" directory already exists.');
        }

        $this->laravel->make('files')->link(
            resource_path('views/template'), public_path('template')
        );

        $this->info('The [public/template] directory has been linked.');
    }
}
