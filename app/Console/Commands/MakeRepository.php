<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    protected $hidden = true;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub() : string
    {
        return __DIR__.'/stubs/make-repository.stub';
    }

    public function getDefaultNamespace($rootNamespace) : string
    {
        return $rootNamespace . '\Repositories';
    }

    public function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['DummyRepository', 'DummyInterface', 'DummyModel'], [$class, "I{$class}", $this->option("model")], $stub);
    }

    protected function getOptions()
    {
        return [
            ['model', '', InputOption::VALUE_REQUIRED, "Input existing model"]
        ];
    }
}
