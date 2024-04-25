<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Jugador;

final class JugadorRepository extends BaseRepository
{
    public function checkAndGetJugador(int $jugadorId): Jugador
    {
        $query = 'SELECT * FROM `jugadores` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $jugadorId);
        $statement->execute();
        $jugador = $statement->fetchObject(Jugador::class);
        if (! $jugador) {
            throw new \App\Exception\Jugador('Jugador not found.', 404);
        }

        return $jugador;
    }

    /**
     * @return array<string>
     */
    public function getJugadores(): array
    {
        $query = 'SELECT * FROM `jugadores` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryJugadoresByPage(): string
    {
        return "
            SELECT *
            FROM `jugadores`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getJugadoresByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryJugadoresByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam(':name', $params['name']);
        $statement->bindParam(':description', $params['description']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultsWithPagination(
            $query,
            $page,
            $perPage,
            $params,
            $total
        );
    }

    public function createJugador(Jugador $jugador): Jugador
    {
        $query = '
            INSERT INTO `jugadores`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $jugador->getName();
        $desc = $jugador->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetJugador((int) $this->database->lastInsertId());
    }

    public function updateJugador(Jugador $jugador): Jugador
    {
        $query = '
            UPDATE `jugadores`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $jugador->getId();
        $name = $jugador->getName();
        $desc = $jugador->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetJugador((int) $id);
    }

    public function deleteJugador(int $jugadorId): void
    {
        $query = 'DELETE FROM `jugadores` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $jugadorId);
        $statement->execute();
    }
}
