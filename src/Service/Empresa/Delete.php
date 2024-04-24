<?php

declare(strict_types=1);

namespace App\Service\Empresa;

final class Delete extends Base
{
    public function delete(int $empresaId): void
    {
        $this->getOneFromDb($empresaId);
        $this->empresaRepository->deleteEmpresa($empresaId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($empresaId);
        }
    }
}
