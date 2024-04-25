<?php

declare(strict_types=1);

namespace App\Service\Partido;

use App\Entity\Partido;
use App\Exception\Partido as PartidoException;
use App\Repository\PartidoRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'partido:%s';

    public function __construct(
        protected PartidoRepository $partidoRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validatePartidoName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new PartidoException('The name of the partido is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $partidoId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $partidoId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $partido = $this->redisService->get($key);
        } else {
            $partido = $this->getOneFromDb($partidoId)->toJson();
            $this->redisService->setex($key, $partido);
        }

        return $partido;
    }

    protected function getOneFromDb(int $partidoId): Partido
    {
        return $this->partidoRepository->checkAndGetPartido($partidoId);
    }

    protected function saveInCache(int $id, object $partido): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $partido);
    }

    protected function deleteFromCache(int $partidoId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $partidoId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
