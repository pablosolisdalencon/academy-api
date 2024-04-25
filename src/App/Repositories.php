<?php

declare(strict_types=1);

use App\Repository\EmpresaRepository;
use App\Repository\JugadorRepository;
use App\Repository\CategoriaRepository;
use App\Repository\CampeonatoRepository;
use App\Repository\NominaRepository;
use App\Repository\PartidoRepository;
use App\Repository\ProfesorRepository;

use App\Repository\NoteRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;

$container['user_repository'] = static fn (
    ContainerInterface $container
): UserRepository => new UserRepository($container->get('db'));

$container['task_repository'] = static fn (
    ContainerInterface $container
): TaskRepository => new TaskRepository($container->get('db'));

$container['note_repository'] = static fn (
    ContainerInterface $container
): NoteRepository => new NoteRepository($container->get('db'));



$container['empresa_repository'] = static fn (
    ContainerInterface $container
): EmpresaRepository => new EmpresaRepository($container->get('db'));

$container['jugador_repository'] = static fn (
    ContainerInterface $container
): JugadorRepository => new JugadorRepository($container->get('db'));

$container['categoria_repository'] = static fn (
    ContainerInterface $container
): CategoriaRepository => new CategoriaRepository($container->get('db'));

$container['campeonato_repository'] = static fn (
    ContainerInterface $container
): CampeonatoRepository => new CampeonatoRepository($container->get('db'));

$container['partido_repository'] = static fn (
    ContainerInterface $container
): PartidoRepository => new PartidoRepository($container->get('db'));

$container['nomina_repository'] = static fn (
    ContainerInterface $container
): NominaRepository => new NominaRepository($container->get('db'));

$container['profesor_repository'] = static fn (
    ContainerInterface $container
): ProfesorRepository => new ProfesorRepository($container->get('db'));

