<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;
use App\Exception\Categoria as CategoriaException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new CategoriaException('Invalid data: name is required.', 400);
        }
        $myCategoria = new Categoria();
        $myCategoria->updateName(self::validateCategoriaName($data->name));
        $description = $data->description ?? null;
        $myCategoria->updateDescription($description);
        /** @var Categoria $categoria */
        $categoria = $this->categoriaRepository->createCategoria($myCategoria);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($categoria->getId(), $categoria->toJson());
        }

        return $categoria->toJson();
    }
}
