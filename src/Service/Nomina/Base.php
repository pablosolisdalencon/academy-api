<?php

declare(strict_types=1);

namespace App\Service\Nomina;

use App\Entity\Nomina;
use App\Exception\Nomina as NominaException;
use App\Repository\NominaRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'nomina:%s';

    public function __construct(
        protected NominaRepository $nominaRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateNominaName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new NominaException('The name of the nómina is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $nominaId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $nominaId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $nomina = $this->redisService->get($key);
        } else {
            $nomina = $this->getOneFromDb($nominaId)->toJson();
            $this->redisService->setex($key, $nomina);
        }

        return $nomina;
    }

    protected function getOneFromDb(int $nominaId): Nomina
    {
        return $this->nominaRepository->checkAndGetNomina($nominaId);
    }

    protected function saveInCache(int $id, object $nomina): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $nomina);
    }

    protected function deleteFromCache(int $nominaId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $nominaId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
