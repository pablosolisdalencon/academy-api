<?php

declare(strict_types=1);

namespace App\Controller\Categoria;

use App\Controller\BaseController;
use App\Service\Categoria\Create;
use App\Service\Categoria\Delete;
use App\Service\Categoria\Find;
use App\Service\Categoria\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindCategoria(): Find
    {
        return $this->container->get('find_categoria_service');
    }

    protected function getServiceCreateCategoria(): Create
    {
        return $this->container->get('create_categoria_service');
    }

    protected function getServiceUpdateCategoria(): Update
    {
        return $this->container->get('update_categoria_service');
    }

    protected function getServiceDeleteCategoria(): Delete
    {
        return $this->container->get('delete_categoria_service');
    }
}
