<?php

declare(strict_types=1);

namespace App\Service\Campeonato;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->campeonatoRepository->getCampeonatos();
    }

    /**
     * @return array<string>
     */
    public function getCampeonatosByPage(
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

        return $this->campeonatoRepository->getCampeonatosByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $campeonatoId): object
    {
        if (self::isRedisEnabled() === true) {
            $campeonato = $this->getOneFromCache($campeonatoId);
        } else {
            $campeonato = $this->getOneFromDb($campeonatoId)->toJson();
        }

        return $campeonato;
    }
}
