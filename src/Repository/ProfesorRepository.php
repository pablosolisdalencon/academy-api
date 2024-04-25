<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Profesor;

final class ProfesorRepository extends BaseRepository
{
    public function checkAndGetProfesor(int $profesorId): Profesor
    {
        $query = 'SELECT * FROM `profesores` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $profesorId);
        $statement->execute();
        $profesor = $statement->fetchObject(Profesor::class);
        if (! $profesor) {
            throw new \App\Exception\Profesor('Profesor not found.', 404);
        }

        return $profesor;
    }

    /**
     * @return array<string>
     */
    public function getProfesores(): array
    {
        $query = 'SELECT * FROM `profesores` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryProfesoresByPage(): string
    {
        return "
            SELECT *
            FROM `profesores`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getProfesoresByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryProfesoresByPage();
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

    public function createProfesor(Profesor $profesor): Profesor
    {
        $query = '
            INSERT INTO `profesores`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $profesor->getName();
        $desc = $profesor->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetProfesor((int) $this->database->lastInsertId());
    }

    public function updateProfesor(Profesor $profesor): Profesor
    {
        $query = '
            UPDATE `profesores`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $profesor->getId();
        $name = $profesor->getName();
        $desc = $profesor->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetProfesor((int) $id);
    }

    public function deleteProfesor(int $profesorId): void
    {
        $query = 'DELETE FROM `profesores` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $profesorId);
        $statement->execute();
    }
}
