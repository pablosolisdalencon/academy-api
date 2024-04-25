<?php

declare(strict_types=1);

namespace App\Service\Profesor;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->profesorRepository->getProfesores();
    }

    /**
     * @return array<string>
     */
    public function getProfesoresByPage(
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

        return $this->profesorRepository->getProfesoresByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $profesorId): object
    {
        if (self::isRedisEnabled() === true) {
            $profesor = $this->getOneFromCache($profesorId);
        } else {
            $profesor = $this->getOneFromDb($profesorId)->toJson();
        }

        return $profesor;
    }
}
