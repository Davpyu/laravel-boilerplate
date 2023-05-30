<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeServiceInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:service-interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'ServiceInterface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service interface';

    protected $hidden = true;

    public function getStub() : string
    {
        return __DIR__.'/stubs/make-service-interface.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Interfaces\Services';
    }

    public function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $requestName = str_replace(['I', "Service"], ['', 'Request'], $class);

        return str_replace(['DummyInterface', 'DummyRequest', 'DummyModel'], [$class, $requestName, $this->option('model')], $stub);
    }

    protected function getOptions()
    {
        return [
            ['model', '', InputOption::VALUE_REQUIRED, "Input existing model"]
        ];
    }
}
