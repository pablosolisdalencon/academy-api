<?php

declare(strict_types=1);

namespace App\Service\Nomina;

use App\Entity\Nomina;
use App\Exception\Nomina as NominaException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new NominaException('Invalid data: name is required.', 400);
        }
        $myNomina = new Nomina();
        $myNomina->updateName(self::validateNominaName($data->name));
        $description = $data->description ?? null;
        $myNomina->updateDescription($description);
        /** @var Nomina $nomina */
        $nomina = $this->nominaRepository->createNomina($myNomina);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($nomina->getId(), $nomina->toJson());
        }

        return $nomina->toJson();
    }
}
