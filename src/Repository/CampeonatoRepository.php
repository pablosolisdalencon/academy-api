<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Campeonato;

final class CampeonatoRepository extends BaseRepository
{
    public function checkAndGetCampeonato(int $campeonatoId): Campeonato
    {
        $query = 'SELECT * FROM `campeonatos` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $campeonatoId);
        $statement->execute();
        $campeonato = $statement->fetchObject(Campeonato::class);
        if (! $campeonato) {
            throw new \App\Exception\Campeonato('Campeonato not found.', 404);
        }

        return $campeonato;
    }

    /**
     * @return array<string>
     */
    public function getCampeonatos(): array
    {
        $query = 'SELECT * FROM `campeonatos` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryCampeonatosByPage(): string
    {
        return "
            SELECT *
            FROM `campeonatos`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getCampeonatosByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryCampeonatosByPage();
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

    public function createCampeonato(Campeonato $campeonato): Campeonato
    {
        $query = '
            INSERT INTO `campeonatos`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $campeonato->getName();
        $desc = $campeonato->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetCampeonato((int) $this->database->lastInsertId());
    }

    public function updateCampeonato(Campeonato $campeonato): Campeonato
    {
        $query = '
            UPDATE `campeonatos`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $campeonato->getId();
        $name = $campeonato->getName();
        $desc = $campeonato->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetCampeonato((int) $id);
    }

    public function deleteCampeonato(int $campeonatoId): void
    {
        $query = 'DELETE FROM `campeonatos` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $campeonatoId);
        $statement->execute();
    }
}
