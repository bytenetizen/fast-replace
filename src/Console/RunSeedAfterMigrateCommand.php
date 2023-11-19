<?php

namespace Bytenetizen\FastReplace\Console;

use Illuminate\Console\Command;

class RunSeedAfterMigrateCommand extends Command
{
    protected $signature = 'replace:seed';
    protected $description = 'Run PlaceholderSeeder after migration';

    public function handle()
    {
        $this->call('db:seed', ['--class' => 'Bytenetizen\FastReplace\Seeders\PlaceholderSeeder']);
    }
}
