<?php

declare(strict_types=1);



use App\Service\Empresa;
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
