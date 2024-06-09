<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    protected $signature = 'migrate:refresh';

    protected $description = 'Command description';

    public function handle(): int
    {

        Storage::disk('public')->deleteDirectory('images');

        $this->call('migrate:fresh',[
            '--seed' => true
        ]);

        return self::SUCCESS;
    }
}
