<?php

declare(strict_types=1);

namespace App\Service\Nomina;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->nominaRepository->getNominas();
    }

    /**
     * @return array<string>
     */
    public function getNominasByPage(
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

        return $this->nominaRepository->getNominasByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $nominaId): object
    {
        if (self::isRedisEnabled() === true) {
            $nomina = $this->getOneFromCache($nominaId);
        } else {
            $nomina = $this->getOneFromDb($nominaId)->toJson();
        }

        return $nomina;
    }
}
