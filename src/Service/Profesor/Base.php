<?php

declare(strict_types=1);

namespace App\Service\Profesor;

use App\Entity\Profesor;
use App\Exception\Profesor as ProfesorException;
use App\Repository\ProfesorRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'profesor:%s';

    public function __construct(
        protected ProfesorRepository $profesorRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateProfesorName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new ProfesorException('The name of the profesor is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $profesorId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $profesorId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $profesor = $this->redisService->get($key);
        } else {
            $profesor = $this->getOneFromDb($profesorId)->toJson();
            $this->redisService->setex($key, $profesor);
        }

        return $profesor;
    }

    protected function getOneFromDb(int $profesorId): Profesor
    {
        return $this->profesorRepository->checkAndGetProfesor($profesorId);
    }

    protected function saveInCache(int $id, object $profesor): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $profesor);
    }

    protected function deleteFromCache(int $profesorId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $profesorId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
