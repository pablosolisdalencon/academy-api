<?php

declare(strict_types=1);

namespace App\Service\Categoria;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->categoriaRepository->getCategorias();
    }

    /**
     * @return array<string>
     */
    public function getCategoriasByPage(
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

        return $this->categoriaRepository->getCategoriasByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $categoriaId): object
    {
        if (self::isRedisEnabled() === true) {
            $categoria = $this->getOneFromCache($categoriaId);
        } else {
            $categoria = $this->getOneFromDb($categoriaId)->toJson();
        }

        return $categoria;
    }
}
