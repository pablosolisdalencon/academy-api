<?php

declare(strict_types=1);

use App\Controller\Empresa;
use App\Controller\Jugador;
use App\Controller\Categoria;
use App\Controller\Campeonato;
use App\Controller\Partido;
use App\Controller\Nomina;
use App\Controller\Profesor;
use App\Controller\Note;
use App\Controller\Task;
use App\Controller\User;
use App\Middleware\Auth;

return static function ($app) {
    $app->get('/', 'App\Controller\DefaultController:getHelp');
    $app->get('/status', 'App\Controller\DefaultController:getStatus');
    $app->post('/login', \App\Controller\User\Login::class);

    $app->group('/api/v1', function () use ($app): void {
        $app->group('/tasks', function () use ($app): void {
            $app->get('', Task\GetAll::class);
            $app->post('', Task\Create::class);
            $app->get('/{id}', Task\GetOne::class);
            $app->put('/{id}', Task\Update::class);
            $app->delete('/{id}', Task\Delete::class);
        })->add(new Auth());

        $app->group('/users', function () use ($app): void {
            $app->get('', User\GetAll::class)->add(new Auth());
            $app->post('', User\Create::class);
            $app->get('/{id}', User\GetOne::class)->add(new Auth());
            $app->put('/{id}', User\Update::class)->add(new Auth());
            $app->delete('/{id}', User\Delete::class)->add(new Auth());
        });

        $app->group('/notes', function () use ($app): void {
            $app->get('', Note\GetAll::class);
            $app->post('', Note\Create::class);
            $app->get('/{id}', Note\GetOne::class);
            $app->put('/{id}', Note\Update::class);
            $app->delete('/{id}', Note\Delete::class);
        });
        
        $app->group('/empresas', function () use ($app): void {
            $app->get('', Empresa\GetAll::class);
            $app->post('', Empresa\Create::class);
            $app->get('/{id}', Empresa\GetOne::class);
            $app->put('/{id}', Empresa\Update::class);
            $app->delete('/{id}', Empresa\Delete::class);
        });

        $app->group('/jugadores', function () use ($app): void {
            $app->get('', Jugador\GetAll::class);
            $app->post('', Jugador\Create::class);
            $app->get('/{id}', Jugador\GetOne::class);
            $app->put('/{id}', Jugador\Update::class);
            $app->delete('/{id}', Jugador\Delete::class);
        });
        $app->group('/categorias', function () use ($app): void {
            $app->get('', Categoria\GetAll::class);
            $app->post('', Categoria\Create::class);
            $app->get('/{id}', Categoria\GetOne::class);
            $app->put('/{id}', Categoria\Update::class);
            $app->delete('/{id}', Categoria\Delete::class);
        });
        $app->group('/campeonatos', function () use ($app): void {
            $app->get('', Campeonato\GetAll::class);
            $app->post('', Campeonato\Create::class);
            $app->get('/{id}', Campeonato\GetOne::class);
            $app->put('/{id}', Campeonato\Update::class);
            $app->delete('/{id}', Campeonato\Delete::class);
        });
        $app->group('/partidos', function () use ($app): void {
            $app->get('', Partido\GetAll::class);
            $app->post('', Partido\Create::class);
            $app->get('/{id}', Partido\GetOne::class);
            $app->put('/{id}', Partido\Update::class);
            $app->delete('/{id}', Partido\Delete::class);
        });
        $app->group('/nominas', function () use ($app): void {
            $app->get('', Nomina\GetAll::class);
            $app->post('', Nomina\Create::class);
            $app->get('/{id}', Nomina\GetOne::class);
            $app->put('/{id}', Nomina\Update::class);
            $app->delete('/{id}', Nomina\Delete::class);
        });
        $app->group('/profesores', function () use ($app): void {
            $app->get('', Profesor\GetAll::class);
            $app->post('', Profesor\Create::class);
            $app->get('/{id}', Profesor\GetOne::class);
            $app->put('/{id}', Profesor\Update::class);
            $app->delete('/{id}', Profesor\Delete::class);
        });

    });

    return $app;
};
