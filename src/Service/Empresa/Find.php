<?php

declare(strict_types=1);

namespace App\Service\Empresa;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->empresaRepository->getEmpresas();
    }

    /**
     * @return array<string>
     */
    public function getEmpresasByPage(
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

        return $this->empresaRepository->getEmpresasByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $empresaId): object
    {
        if (self::isRedisEnabled() === true) {
            $empresa = $this->getOneFromCache($empresaId);
        } else {
            $empresa = $this->getOneFromDb($empresaId)->toJson();
        }

        return $empresa;
    }
}
