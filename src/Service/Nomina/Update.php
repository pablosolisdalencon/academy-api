<?php

declare(strict_types=1);

namespace App\Service\Nomina;

use App\Entity\Nomina;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $nominaId): object
    {
        $nomina = $this->getOneFromDb($nominaId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $nomina->updateName(self::validateNominaName($data->name));
        }
        if (isset($data->description)) {
            $nomina->updateDescription($data->description);
        }
        /** @var Nomina $nominas */
        $nominas = $this->nominaRepository->updateNomina($nomina);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($nominas->getId(), $nominas->toJson());
        }

        return $nominas->toJson();
    }
}
