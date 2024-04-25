<?php

declare(strict_types=1);

namespace App\Controller\Nomina;

use App\Controller\BaseController;
use App\Service\Nomina\Create;
use App\Service\Nomina\Delete;
use App\Service\Nomina\Find;
use App\Service\Nomina\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindNomina(): Find
    {
        return $this->container->get('find_nomina_service');
    }

    protected function getServiceCreateNomina(): Create
    {
        return $this->container->get('create_nomina_service');
    }

    protected function getServiceUpdateNomina(): Update
    {
        return $this->container->get('update_nomina_service');
    }

    protected function getServiceDeleteNomina(): Delete
    {
        return $this->container->get('delete_nomina_service');
    }
}
