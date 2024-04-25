<?php

declare(strict_types=1);

namespace App\Controller\Profesor;

use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $this->getServiceDeleteProfesor()->delete((int) $args['id']);

        return $this->jsonResponse($response, 'success', null, 204);
    }
}
