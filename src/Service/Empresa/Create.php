<?php

declare(strict_types=1);

namespace App\Service\Empresa;

use App\Entity\Empresa;
use App\Exception\Empresa as EmpresaException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new EmpresaException('Invalid data: name is required.', 400);
        }
        $myempresa = new Empresa();
        $myempresa->updateName(self::validateEmpresaName($data->name));
        $description = $data->description ?? null;
        $myempresa->updateDescription($description);
        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->createEmpresa($myempresa);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($empresa->getId(), $empresa->toJson());
        }

        return $empresa->toJson();
    }
}
