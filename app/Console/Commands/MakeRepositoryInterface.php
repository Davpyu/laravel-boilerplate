<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeRepositoryInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository-interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository Interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository interface';

    protected $hidden = true;

    protected function getStub() : string
    {
        return __DIR__.'/stubs/make-repository-interface.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Interfaces\Repositories';
    }

    public function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['DummyInterface', 'DummyModel'], [$class, $this->option("model")], $stub);
    }

    protected function getOptions()
    {
        return [
            ['model', '', InputOption::VALUE_REQUIRED, "Input existing model"]
        ];
    }
}
