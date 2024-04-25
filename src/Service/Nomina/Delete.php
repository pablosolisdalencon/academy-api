<?php

declare(strict_types=1);

namespace App\Service\Nomina;

final class Delete extends Base
{
    public function delete(int $nominaId): void
    {
        $this->getOneFromDb($nominaId);
        $this->nominaRepository->deleteNomina($nominaId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($nominaId);
        }
    }
}
