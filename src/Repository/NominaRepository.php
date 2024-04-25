<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Nomina;

final class NominaRepository extends BaseRepository
{
    public function checkAndGetNomina(int $nominaId): Nomina
    {
        $query = 'SELECT * FROM `nominas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $nominaId);
        $statement->execute();
        $nomina = $statement->fetchObject(Nomina::class);
        if (! $nomina) {
            throw new \App\Exception\Nomina('Nómina not found.', 404);
        }

        return $nomina;
    }

    /**
     * @return array<string>
     */
    public function getNominas(): array
    {
        $query = 'SELECT * FROM `nominas` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryNominasByPage(): string
    {
        return "
            SELECT *
            FROM `nominas`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getNominasByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryNominasByPage();
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

    public function createNomina(Nomina $nomina): Nomina
    {
        $query = '
            INSERT INTO `nominas`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $nomina->getName();
        $desc = $nomina->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetNomina((int) $this->database->lastInsertId());
    }

    public function updateNomina(Nomina $nomina): Nomina
    {
        $query = '
            UPDATE `nominas`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $nomina->getId();
        $name = $nomina->getName();
        $desc = $nomina->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetNomina((int) $id);
    }

    public function deleteNomina(int $nominaId): void
    {
        $query = 'DELETE FROM `nominas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $nominaId);
        $statement->execute();
    }
}
