<?php

declare(strict_types=1);

namespace App\Service\Empresa;

use App\Entity\Empresa;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $empresaId): object
    {
        $empresa = $this->getOneFromDb($empresaId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $empresa->updateName(self::validateEmpresaName($data->name));
        }
        if (isset($data->description)) {
            $empresa->updateDescription($data->description);
        }
        /** @var Empresa $empresas */
        $empresas = $this->empresaRepository->updateEmpresa($empresa);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($empresas->getId(), $empresas->toJson());
        }

        return $empresas->toJson();
    }
}
