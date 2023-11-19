<?php

namespace Bytenetizen\FastReplace\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakePlaceholder extends Command
{

    protected $signature = 'make:placeholder {name}';
    protected $description = 'Create a new placeholder class';

    public function handle()
    {
        $name = $this->argument('name');
        $namespace = 'App\\Services\\PieceMutators';

        $stub = File::get(__DIR__.'/../Stubs/placeholder.stub');

        $content = str_replace(['{{namespace}}', '{{class}}'], [$namespace, $name], $stub);

        $directory = app_path('Services/PieceMutators');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($directory . '/' . $name . '.php', $content);

        $this->info('Placeholder created successfully.');
    }

}
