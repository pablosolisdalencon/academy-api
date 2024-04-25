<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Partido;

final class PartidoRepository extends BaseRepository
{
    public function checkAndGetPartido(int $partidoId): Partido
    {
        $query = 'SELECT * FROM `partidos` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $partidoId);
        $statement->execute();
        $partido = $statement->fetchObject(Partido::class);
        if (! $partido) {
            throw new \App\Exception\Partido('Partido not found.', 404);
        }

        return $partido;
    }

    /**
     * @return array<string>
     */
    public function getPartidos(): array
    {
        $query = 'SELECT * FROM `partidos` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryPartidosByPage(): string
    {
        return "
            SELECT *
            FROM `partidos`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getPartidosByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryPartidosByPage();
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

    public function createPartido(Partido $partido): Partido
    {
        $query = '
            INSERT INTO `partidos`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $partido->getName();
        $desc = $partido->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetPartido((int) $this->database->lastInsertId());
    }

    public function updatePartido(Partido $partido): Partido
    {
        $query = '
            UPDATE `partidos`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $partido->getId();
        $name = $partido->getName();
        $desc = $partido->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetPartido((int) $id);
    }

    public function deletePartido(int $partidoId): void
    {
        $query = 'DELETE FROM `partidos` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $partidoId);
        $statement->execute();
    }
}
