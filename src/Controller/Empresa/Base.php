<?php

declare(strict_types=1);

namespace App\Controller\Empresa;

use App\Controller\BaseController;
use App\Service\Empresa\Create;
use App\Service\Empresa\Delete;
use App\Service\Empresa\Find;
use App\Service\Empresa\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindEmpresa(): Find
    {
        return $this->container->get('find_empresa_service');
    }

    protected function getServiceCreateEmpresa(): Create
    {
        return $this->container->get('create_empresa_service');
    }

    protected function getServiceUpdateEmpresa(): Update
    {
        return $this->container->get('update_empresa_service');
    }

    protected function getServiceDeleteEmpresa(): Delete
    {
        return $this->container->get('delete_empresa_service');
    }
}
