<?php

declare(strict_types=1);

namespace App\Service\Jugador;

use App\Entity\Jugador;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $jugadorId): object
    {
        $jugador = $this->getOneFromDb($jugadorId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $jugador->updateName(self::validateJugadorName($data->name));
        }
        if (isset($data->description)) {
            $jugador->updateDescription($data->description);
        }
        /** @var Jugador $jugadores */
        $jugadores = $this->jugadorRepository->updateJugador($jugador);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($jugadores->getId(), $jugadores->toJson());
        }

        return $jugadores->toJson();
    }
}
