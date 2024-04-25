<?php

declare(strict_types=1);

namespace App\Controller\Jugador;

use App\Controller\BaseController;
use App\Service\Jugador\Create;
use App\Service\Jugador\Delete;
use App\Service\Jugador\Find;
use App\Service\Jugador\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindJugador(): Find
    {
        return $this->container->get('find_jugador_service');
    }

    protected function getServiceCreateJugador(): Create
    {
        return $this->container->get('create_jugador_service');
    }

    protected function getServiceUpdateJugador(): Update
    {
        return $this->container->get('update_jugador_service');
    }

    protected function getServiceDeleteJugador(): Delete
    {
        return $this->container->get('delete_jugador_service');
    }
}
