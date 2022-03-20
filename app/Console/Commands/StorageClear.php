<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class StorageClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Storage/app/public folder';

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
        $files = Storage::disk('public')->allFiles('/');
        $this->info('Was finded '.count($files).' files in storage/app/public');
        $this->info('Deleting...');
        foreach ($files as $file) {
            if (basename($file) !== '.gitignore') {
                Storage::disk('public')->delete($file);
            };
        };
        $this->info('All files deleted successfully!');
        return 0;
    }
}
