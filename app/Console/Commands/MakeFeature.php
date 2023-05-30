<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:feature')]
class MakeFeature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:feature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make form request, repository and services in one command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $option = $this->option('model') ?: $name;

        if (! class_exists("App\\Models\\{$option}")) {
            $this->error("Model not found! Please make sure you have a model with name '{$option}' on your App\Models");
            return;
        }

        $this->call('make:request', [
            'name' => "{$name}Request",
        ]);

        $this->call('make:repository-interface',[
            'name' => "I{$name}Repository",
            '--model' => $option
        ]);

        $this->call('make:repository', [
            'name' => "{$name}Repository",
            '--model' => $option
        ]);

        $this->call('make:service-interface', [
            'name' => "I{$name}Service",
            '--model' => $option
        ]);

        $this->call('make:service', [
            'name' => "{$name}Service",
            '--model' => $option
        ]);
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the feature'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['model', '', InputOption::VALUE_REQUIRED, "Input existing model"]
        ];
    }
}
