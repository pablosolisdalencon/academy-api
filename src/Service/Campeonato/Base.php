<?php

declare(strict_types=1);

namespace App\Service\Campeonato;

use App\Entity\Campeonato;
use App\Exception\Campeonato as CampeonatoException;
use App\Repository\CampeonatoRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'campeonato:%s';

    public function __construct(
        protected CampeonatoRepository $campeonatoRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateCampeonatoName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new CampeonatoException('The name of the campeonato is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $campeonatoId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $campeonatoId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $campeonato = $this->redisService->get($key);
        } else {
            $campeonato = $this->getOneFromDb($campeonatoId)->toJson();
            $this->redisService->setex($key, $campeonato);
        }

        return $campeonato;
    }

    protected function getOneFromDb(int $campeonatoId): Campeonato
    {
        return $this->campeonatoRepository->checkAndGetCampeonato($campeonatoId);
    }

    protected function saveInCache(int $id, object $campeonato): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $campeonato);
    }

    protected function deleteFromCache(int $campeonatoId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $campeonatoId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
