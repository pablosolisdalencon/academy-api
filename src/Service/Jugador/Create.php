<?php

declare(strict_types=1);

namespace App\Service\Jugador;

use App\Entity\Jugador;
use App\Exception\Jugador as JugadorException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new JugadorException('Invalid data: name is required.', 400);
        }
        $myJugador = new Jugador();
        $myJugador->updateName(self::validateJugadorName($data->name));
        $description = $data->description ?? null;
        $myJugador->updateDescription($description);
        /** @var Jugador $jugador */
        $jugador = $this->jugadorRepository->createJugador($myJugador);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($jugador->getId(), $jugador->toJson());
        }

        return $jugador->toJson();
    }
}
