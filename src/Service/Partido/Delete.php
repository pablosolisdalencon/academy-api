<?php

declare(strict_types=1);

namespace App\Service\Partido;

final class Delete extends Base
{
    public function delete(int $partidoId): void
    {
        $this->getOneFromDb($partidoId);
        $this->partidoRepository->deletePartido($partidoId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($partidoId);
        }
    }
}
