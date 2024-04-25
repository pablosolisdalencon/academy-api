<?php

declare(strict_types=1);

namespace App\Service\Campeonato;

final class Delete extends Base
{
    public function delete(int $campeonatoId): void
    {
        $this->getOneFromDb($campeonatoId);
        $this->campeonatoRepository->deleteCampeonato($campeonatoId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($campeonatoId);
        }
    }
}
