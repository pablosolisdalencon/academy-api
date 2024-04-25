<?php

declare(strict_types=1);

namespace App\Service\Campeonato;

use App\Entity\Campeonato;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $campeonatoId): object
    {
        $campeonato = $this->getOneFromDb($campeonatoId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $campeonato->updateName(self::validateCampeonatoName($data->name));
        }
        if (isset($data->description)) {
            $campeonato->updateDescription($data->description);
        }
        /** @var Campeonato $campeonatos */
        $campeonatos = $this->campeonatoRepository->updateCampeonato($campeonato);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($campeonatos->getId(), $campeonatos->toJson());
        }

        return $campeonatos->toJson();
    }
}
