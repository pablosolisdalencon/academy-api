<?php

declare(strict_types=1);

namespace App\Service\Profesor;

final class Delete extends Base
{
    public function delete(int $profesorId): void
    {
        $this->getOneFromDb($profesorId);
        $this->profesorRepository->deleteProfesor($profesorId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($profesorId);
        }
    }
}
