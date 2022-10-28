<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class InterfaceMakeCommand extends GeneratorCommand
{
    protected $name = 'make:interface';

    protected $description = 'Create new interface file for repository or service ';

    protected $type = "Interface";

    public function handle()
    {
        if(!$this->option('service') && !$this->option('repository'))
        {
            throw new InvalidArgumentException("Missing require option");
        }

        parent::handle();
    }

    protected function rootNamespace()
    {
        return "Core\\";
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $defaultNameSapce = "Core";
        
        if($this->option("service"))
        {
            $defaultNameSapce = "Core\Services\Contracts";
        }

        if ($this->option("repository")) 
        {
            $defaultNameSapce = "Core\Repositories\Contracts";
        }

        return $defaultNameSapce;
    }

    protected function getStub()
    {
        return  __DIR__.'/stubs/Interface.stub';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path().'/core/'.str_replace('\\', '/', $name).'.php';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['service', 's', InputOption::VALUE_NONE, 'Create a new interface for the service'],
            ['repository', 'r', InputOption::VALUE_NONE, 'Create a new interface for the service']
        ];
    }
}
