<?php

declare(strict_types=1);

namespace App\Service\Partido;

use App\Entity\Partido;
use App\Exception\Partido as PartidoException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new PartidoException('Invalid data: name is required.', 400);
        }
        $myPartido = new Partido();
        $myPartido->updateName(self::validatePartidoName($data->name));
        $description = $data->description ?? null;
        $myPartido->updateDescription($description);
        /** @var Partido $partido */
        $partido = $this->partidoRepository->createPartido($myPartido);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($partido->getId(), $partido->toJson());
        }

        return $partido->toJson();
    }
}
