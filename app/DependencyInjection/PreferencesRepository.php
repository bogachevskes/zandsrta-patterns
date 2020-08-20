<?php

namespace App\DependencyInjection;

use App\DependencyInjection\Base\ConfigurableInstance;

class PreferencesRepository
{
    protected $repository;
    
    public function __construct(ConfigurableInstance $repository)
    {
        $this->setRepository($repository);
    }

    public function setRepository(ConfigurableInstance $repository)
    {
        $this->repository = $repository;
    }

    public function getRepository(): ConfigurableInstance
    {
        return $this->repository;
    }
}