<?php

declare(strict_types=1);

namespace App\Service\Jugador;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->jugadorRepository->getJugadores();
    }

    /**
     * @return array<string>
     */
    public function getJugadoresByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        if ($page < 1) {
            $page = 1;
        }
        if ($perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->jugadorRepository->getJugadoresByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $jugadorId): object
    {
        if (self::isRedisEnabled() === true) {
            $jugador = $this->getOneFromCache($jugadorId);
        } else {
            $jugador = $this->getOneFromDb($jugadorId)->toJson();
        }

        return $jugador;
    }
}
