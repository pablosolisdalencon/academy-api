<?php

declare(strict_types=1);

namespace App\Controller\Jugador;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(
        Request $request,
        Response $response
    ): Response {
        $page = $request->getQueryParam('page', null);
        $perPage = $request->getQueryParam('perPage', null);
        $name = $request->getQueryParam('name', null);
        $description = $request->getQueryParam('description', null);

        $jugadores = $this->getServiceFindJugador()
            ->getJugadoresByPage((int) $page, (int) $perPage, $name, $description);

        return $this->jsonResponse($response, 'success', $jugadores, 200);
    }
}