<?php

declare(strict_types=1);

namespace App\Controller\Campeonato;

use App\Controller\BaseController;
use App\Service\Campeonato\Create;
use App\Service\Campeonato\Delete;
use App\Service\Campeonato\Find;
use App\Service\Campeonato\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindCampeonato(): Find
    {
        return $this->container->get('find_campeonato_service');
    }

    protected function getServiceCreateCampeonato(): Create
    {
        return $this->container->get('create_campeonato_service');
    }

    protected function getServiceUpdateCampeonato(): Update
    {
        return $this->container->get('update_campeonato_service');
    }

    protected function getServiceDeleteCampeonato(): Delete
    {
        return $this->container->get('delete_campeonato_service');
    }
}
