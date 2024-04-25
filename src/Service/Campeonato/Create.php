<?php

declare(strict_types=1);

namespace App\Service\Campeonato;

use App\Entity\Campeonato;
use App\Exception\Campeonato as CampeonatoException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new CampeonatoException('Invalid data: name is required.', 400);
        }
        $myCampeonato = new Campeonato();
        $myCampeonato->updateName(self::validateCampeonatoName($data->name));
        $description = $data->description ?? null;
        $myCampeonato->updateDescription($description);
        /** @var Campeonato $campeonato */
        $campeonato = $this->campeonatoRepository->createCampeonato($myCampeonato);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($campeonato->getId(), $campeonato->toJson());
        }

        return $campeonato->toJson();
    }
}
