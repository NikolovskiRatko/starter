<?php
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class CreateControllerFile extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:controller {name : The required name of the entity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Controller for the back-end implementation of a draggable ordering datatable CRUD for a taxonomy type entity';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller for CRUD functionality of a given entity';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/controller.stub';
    }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the command.'],
        ];
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Applications\Common\Controllers';
    }
}