<?php

declare(strict_types=1);

namespace App\Service\Jugador;

use App\Entity\Jugador;
use App\Exception\Jugador as JugadorException;
use App\Repository\JugadorRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'jugador:%s';

    public function __construct(
        protected JugadorRepository $jugadorRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateJugadorName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new JugadorException('The name of the jugador is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $jugadorId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $jugadorId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $jugador = $this->redisService->get($key);
        } else {
            $jugador = $this->getOneFromDb($jugadorId)->toJson();
            $this->redisService->setex($key, $jugador);
        }

        return $jugador;
    }

    protected function getOneFromDb(int $jugadorId): Jugador
    {
        return $this->jugadorRepository->checkAndGetJugador($jugadorId);
    }

    protected function saveInCache(int $id, object $jugador): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $jugador);
    }

    protected function deleteFromCache(int $jugadorId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $jugadorId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
