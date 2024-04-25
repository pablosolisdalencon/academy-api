<?php

declare(strict_types=1);

namespace App\Service\Jugador;

final class Delete extends Base
{
    public function delete(int $jugadorId): void
    {
        $this->getOneFromDb($jugadorId);
        $this->jugadorRepository->deleteJugador($jugadorId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($jugadorId);
        }
    }
}
