<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service';

    protected $hidden = true;

    protected function getStub() : string
    {
        return __DIR__.'/stubs/make-service.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }

    public function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $cleanName = str_replace("Service", "", $class);

        return str_replace(['DummyService', 'DummyInterface', 'DummyRepository', 'DummyRequest', 'DummyModel'], [$class, "I{$class}", "I{$cleanName}Repository", "{$cleanName}Request", $this->option("model")], $stub);
    }

    protected function getOptions()
    {
        return [
            ['model', '', InputOption::VALUE_REQUIRED, "Input existing model"]
        ];
    }
}
