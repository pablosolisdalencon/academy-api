<?php

declare(strict_types=1);

namespace App\Service\Empresa;

use App\Entity\Empresa;
use App\Exception\Empresa as EmpresaException;
use App\Repository\EmpresaRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'empresa:%s';

    public function __construct(
        protected EmpresaRepository $empresaRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateEmpresaName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new EmpresaException('The name of the empresa is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $empresaId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $empresaId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $empresa = $this->redisService->get($key);
        } else {
            $empresa = $this->getOneFromDb($empresaId)->toJson();
            $this->redisService->setex($key, $empresa);
        }

        return $empresa;
    }

    protected function getOneFromDb(int $empresaId): Empresa
    {
        return $this->empresaRepository->checkAndGetEmpresa($empresaId);
    }

    protected function saveInCache(int $id, object $empresa): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $empresa);
    }

    protected function deleteFromCache(int $empresaId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $empresaId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
