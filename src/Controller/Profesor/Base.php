<?php

declare(strict_types=1);

namespace App\Controller\Profesor;

use App\Controller\BaseController;
use App\Service\Profesor\Create;
use App\Service\Profesor\Delete;
use App\Service\Profesor\Find;
use App\Service\Profesor\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindProfesor(): Find
    {
        return $this->container->get('find_profesor_service');
    }

    protected function getServiceCreateProfesor(): Create
    {
        return $this->container->get('create_profesor_service');
    }

    protected function getServiceUpdateProfesor(): Update
    {
        return $this->container->get('update_profesor_service');
    }

    protected function getServiceDeleteProfesor(): Delete
    {
        return $this->container->get('delete_profesor_service');
    }
}
