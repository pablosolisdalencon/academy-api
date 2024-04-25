<?php

declare(strict_types=1);

namespace App\Service\Profesor;

use App\Entity\Profesor;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $profesorId): object
    {
        $profesor = $this->getOneFromDb($profesorId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $profesor->updateName(self::validateProfesorName($data->name));
        }
        if (isset($data->description)) {
            $profesor->updateDescription($data->description);
        }
        /** @var Profesor $profesores */
        $profesores = $this->profesorRepository->updateProfesor($profesor);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($profesores->getId(), $profesores->toJson());
        }

        return $profesores->toJson();
    }
}
