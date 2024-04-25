<?php

declare(strict_types=1);

namespace App\Service\Partido;

use App\Entity\Partido;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $partidoId): object
    {
        $partido = $this->getOneFromDb($partidoId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $partido->updateName(self::validatePartidoName($data->name));
        }
        if (isset($data->description)) {
            $partido->updateDescription($data->description);
        }
        /** @var Partido $partidos */
        $partidos = $this->partidoRepository->updatePartido($partido);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($partidos->getId(), $partidos->toJson());
        }

        return $partidos->toJson();
    }
}
