<?php

declare(strict_types=1);



use App\Service\Empresa;
use App\Service\Jugador;
use App\Service\Categoria;
use App\Service\Campeonato;
use App\Service\Partido;
use App\Service\Nomina;
use App\Service\Profesor;
use App\Service\Note;
use App\Service\Task\TaskService;
use App\Service\User;
use Psr\Container\ContainerInterface;

$container['find_user_service'] = static fn (
    ContainerInterface $container
): User\Find => new User\Find(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['create_user_service'] = static fn (
    ContainerInterface $container
): User\Create => new User\Create(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['update_user_service'] = static fn (
    ContainerInterface $container
): User\Update => new User\Update(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['delete_user_service'] = static fn (
    ContainerInterface $container
): User\Delete => new User\Delete(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['login_user_service'] = static fn (
    ContainerInterface $container
): User\Login => new User\Login(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['task_service'] = static fn (
    ContainerInterface $container
): TaskService => new TaskService(
    $container->get('task_repository'),
    $container->get('redis_service')
);

$container['find_note_service'] = static fn (
    ContainerInterface $container
): Note\Find => new Note\Find(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['create_note_service'] = static fn (
    ContainerInterface $container
): Note\Create => new Note\Create(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['update_note_service'] = static fn (
    ContainerInterface $container
): Note\Update => new Note\Update(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['delete_note_service'] = static fn (
    ContainerInterface $container
): Note\Delete => new Note\Delete(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['find_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Find => new Empresa\Find(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);

$container['create_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Create => new Empresa\Create(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);

$container['update_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Update => new Empresa\Update(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);

$container['delete_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Delete => new Empresa\Delete(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);


$container['find_jugador_service'] = static fn (
    ContainerInterface $container
): Jugador\Find => new Jugador\Find(
    $container->get('jugador_repository'),
    $container->get('redis_service')
);

$container['create_jugador_service'] = static fn (
    ContainerInterface $container
): Jugador\Create => new Jugador\Create(
    $container->get('jugador_repository'),
    $container->get('redis_service')
);

$container['update_jugador_service'] = static fn (
    ContainerInterface $container
): Jugador\Update => new Jugador\Update(
    $container->get('jugador_repository'),
    $container->get('redis_service')
);

$container['delete_jugador_service'] = static fn (
    ContainerInterface $container
): Jugador\Delete => new Jugador\Delete(
    $container->get('jugador_repository'),
    $container->get('redis_service')
);


$container['find_categoria_service'] = static fn (
    ContainerInterface $container
): Categoria\Find => new Categoria\Find(
    $container->get('categoria_repository'),
    $container->get('redis_service')
);

$container['create_categoria_service'] = static fn (
    ContainerInterface $container
): Categoria\Create => new Categoria\Create(
    $container->get('categoria_repository'),
    $container->get('redis_service')
);

$container['update_categoria_service'] = static fn (
    ContainerInterface $container
): Categoria\Update => new Categoria\Update(
    $container->get('categoria_repository'),
    $container->get('redis_service')
);

$container['delete_categoria_service'] = static fn (
    ContainerInterface $container
): Categoria\Delete => new Categoria\Delete(
    $container->get('categoria_repository'),
    $container->get('redis_service')
);


$container['find_campeonato_service'] = static fn (
    ContainerInterface $container
): Campeonato\Find => new Campeonato\Find(
    $container->get('campeonato_repository'),
    $container->get('redis_service')
);

$container['create_campeonato_service'] = static fn (
    ContainerInterface $container
): Campeonato\Create => new Campeonato\Create(
    $container->get('campeonato_repository'),
    $container->get('redis_service')
);

$container['update_campeonato_service'] = static fn (
    ContainerInterface $container
): Campeonato\Update => new Campeonato\Update(
    $container->get('campeonato_repository'),
    $container->get('redis_service')
);

$container['delete_campeonato_service'] = static fn (
    ContainerInterface $container
): Campeonato\Delete => new Campeonato\Delete(
    $container->get('campeonato_repository'),
    $container->get('redis_service')
);


$container['find_partido_service'] = static fn (
    ContainerInterface $container
): Partido\Find => new Partido\Find(
    $container->get('partido_repository'),
    $container->get('redis_service')
);

$container['create_partido_service'] = static fn (
    ContainerInterface $container
): Partido\Create => new Partido\Create(
    $container->get('partido_repository'),
    $container->get('redis_service')
);

$container['update_partido_service'] = static fn (
    ContainerInterface $container
): Partido\Update => new Partido\Update(
    $container->get('partido_repository'),
    $container->get('redis_service')
);

$container['delete_partido_service'] = static fn (
    ContainerInterface $container
): Partido\Delete => new Partido\Delete(
    $container->get('partido_repository'),
    $container->get('redis_service')
);


$container['find_nomina_service'] = static fn (
    ContainerInterface $container
): Nomina\Find => new Nomina\Find(
    $container->get('nomina_repository'),
    $container->get('redis_service')
);

$container['create_nomina_service'] = static fn (
    ContainerInterface $container
): Nomina\Create => new Nomina\Create(
    $container->get('nomina_repository'),
    $container->get('redis_service')
);

$container['update_nomina_service'] = static fn (
    ContainerInterface $container
): Nomina\Update => new Nomina\Update(
    $container->get('nomina_repository'),
    $container->get('redis_service')
);

$container['delete_nomina_service'] = static fn (
    ContainerInterface $container
): Nomina\Delete => new Nomina\Delete(
    $container->get('nomina_repository'),
    $container->get('redis_service')
);
$container['find_profesor_service'] = static fn (
    ContainerInterface $container
): Profesor\Find => new Profesor\Find(
    $container->get('profesor_repository'),
    $container->get('redis_service')
);

$container['create_profesor_service'] = static fn (
    ContainerInterface $container
): Profesor\Create => new Profesor\Create(
    $container->get('profesor_repository'),
    $container->get('redis_service')
);

$container['update_profesor_service'] = static fn (
    ContainerInterface $container
): Profesor\Update => new Profesor\Update(
    $container->get('profesor_repository'),
    $container->get('redis_service')
);

$container['delete_profesor_service'] = static fn (
    ContainerInterface $container
): Profesor\Delete => new Profesor\Delete(
    $container->get('profesor_repository'),
    $container->get('redis_service')
);
