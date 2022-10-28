<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends GeneratorCommand
{

    protected $name = 'core:make-repository';

    protected $description = 'Command make repository';

    protected $type = "Repository";
  
    public function handle()
    {
        $this->createRepositoryInterface();
        parent::handle();
    }

    protected function createRepositoryInterface()
    {
        $repositoryName = Str::studly(class_basename($this->argument('name')));
    
        $this->call('make:interface', [
            'name'  => "{$repositoryName}RepositoryContract",
            '-r'   => true
        ]);        
    }

    protected function getStub()
    {
        return  __DIR__.'/stubs/Repository.stub';
    }

    protected function buildClass($name)
    {
        $repositoryName = Str::studly(class_basename($this->argument('name')));

        return str_replace( 
            ['{{dummyName}}', '{{ dummyName }}', 'dummyName'], 
            $repositoryName, 
            parent::buildClass($name)
        );
    }

    protected function rootNamespace()
    {
        return "Core\\";
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'Core\Repositories';
    }
    
    protected function getPath($name)
    {
        $name = $name."Repository";
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path().'/core/'.str_replace('\\', '/', $name).'.php';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }

}
