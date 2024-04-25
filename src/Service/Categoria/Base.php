<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;
use App\Exception\Categoria as CategoriaException;
use App\Repository\CategoriaRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'categoria:%s';

    public function __construct(
        protected CategoriaRepository $categoriaRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateCategoriaName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new CategoriaException('The name of the categoria is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $categoriaId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $categoriaId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $categoria = $this->redisService->get($key);
        } else {
            $categoria = $this->getOneFromDb($categoriaId)->toJson();
            $this->redisService->setex($key, $categoria);
        }

        return $categoria;
    }

    protected function getOneFromDb(int $categoriaId): Categoria
    {
        return $this->categoriaRepository->checkAndGetCategoria($categoriaId);
    }

    protected function saveInCache(int $id, object $categoria): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $categoria);
    }

    protected function deleteFromCache(int $categoriaId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $categoriaId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
