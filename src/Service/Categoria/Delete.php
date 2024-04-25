<?php

declare(strict_types=1);

namespace App\Service\Categoria;

final class Delete extends Base
{
    public function delete(int $categoriaId): void
    {
        $this->getOneFromDb($categoriaId);
        $this->categoriaRepository->deleteCategoria($categoriaId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($categoriaId);
        }
    }
}
