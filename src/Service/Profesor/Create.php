<?php

declare(strict_types=1);

namespace App\Service\Profesor;

use App\Entity\Profesor;
use App\Exception\Profesor as ProfesorException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new ProfesorException('Invalid data: name is required.', 400);
        }
        $myProfesor = new Profesor();
        $myProfesor->updateName(self::validateProfesorName($data->name));
        $description = $data->description ?? null;
        $myProfesor->updateDescription($description);
        /** @var Profesor $profesor */
        $profesor = $this->profesorRepository->createProfesor($myProfesor);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($profesor->getId(), $profesor->toJson());
        }

        return $profesor->toJson();
    }
}
