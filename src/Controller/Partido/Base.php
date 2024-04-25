<?php

declare(strict_types=1);

namespace App\Controller\Partido;

use App\Controller\BaseController;
use App\Service\Partido\Create;
use App\Service\Partido\Delete;
use App\Service\Partido\Find;
use App\Service\Partido\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindPartido(): Find
    {
        return $this->container->get('find_partido_service');
    }

    protected function getServiceCreatePartido(): Create
    {
        return $this->container->get('create_partido_service');
    }

    protected function getServiceUpdatePartido(): Update
    {
        return $this->container->get('update_partido_service');
    }

    protected function getServiceDeletePartido(): Delete
    {
        return $this->container->get('delete_partido_service');
    }
}
