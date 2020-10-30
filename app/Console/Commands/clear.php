<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class clear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all caches';

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
        Artisan::call('clear-compiled');
        Artisan::call('auth:clear-resets');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('event:clear');
        Artisan::call('optimize:clear');
        Artisan::call('permission:cache-reset');
        Artisan::call('queue:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        return 'All Cleared';
    }
}
