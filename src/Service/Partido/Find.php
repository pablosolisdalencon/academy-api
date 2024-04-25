<?php

declare(strict_types=1);

namespace App\Service\Partido;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->partidoRepository->getPartidos();
    }

    /**
     * @return array<string>
     */
    public function getPartidosByPage(
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

        return $this->partidoRepository->getPartidosByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $partidoId): object
    {
        if (self::isRedisEnabled() === true) {
            $partido = $this->getOneFromCache($partidoId);
        } else {
            $partido = $this->getOneFromDb($partidoId)->toJson();
        }

        return $partido;
    }
}
