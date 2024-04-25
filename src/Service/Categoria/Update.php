<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $categoriaId): object
    {
        $categoria = $this->getOneFromDb($categoriaId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $categoria->updateName(self::validateCategoriaName($data->name));
        }
        if (isset($data->description)) {
            $categoria->updateDescription($data->description);
        }
        /** @var Categoria $categorias */
        $categorias = $this->categoriaRepository->updateCategoria($categoria);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($categorias->getId(), $categorias->toJson());
        }

        return $categorias->toJson();
    }
}
