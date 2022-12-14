<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ServiceMakeCommand extends GeneratorCommand
{

    protected $name = 'make:service';

    protected $description = 'Create core service';

    protected $type = 'Service';

    public function handle()
    {
        $this->createServiceInterface();
        parent::handle();
    }

    protected function createServiceInterface()
    {
        $serviceName = Str::studly(class_basename($this->argument('name')));
    
        $this->call('make:interface', [
            'name'  => "{$serviceName}Contract",
            '-s'   => true
        ]);        
    }
 
    protected function getStub()
    {
        return __DIR__.'/Stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'Core\Services';
    }

    protected function rootNamespace()
    {
        return "Core\\";
    }

    protected function buildClass($name)
    {   
        $serviceName = Str::studly(class_basename(str_replace('Service', '', $this->argument('name'))));
        
        return str_replace( 
            ['{{dummyName}}', '{{ dummyName }}', 'dummyName'], 
            $serviceName, 
            parent::buildClass($name)
        );
    }

    protected function getPath($name)
    {
        $name = $name;
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
