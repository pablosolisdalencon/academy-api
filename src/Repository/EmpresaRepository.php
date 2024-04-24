<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Empresa;

final class EmpresaRepository extends BaseRepository
{
    public function checkAndGetEmpresa(int $empresaId): Empresa
    {
        $query = 'SELECT * FROM `empresas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $empresaId);
        $statement->execute();
        $empresa = $statement->fetchObject(Empresa::class);
        if (! $empresa) {
            throw new \App\Exception\Empresa('empresa not found.', 404);
        }

        return $empresa;
    }

    /**
     * @return array<string>
     */
    public function getEmpresas(): array
    {
        $query = 'SELECT * FROM `empresas` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryEmpresasByPage(): string
    {
        return "
            SELECT *
            FROM `empresas`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getEmpresasByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryEmpresasByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $params['name']);
        $statement->bindParam('description', $params['description']);
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

    public function createEmpresa(Empresa $empresa): Empresa
    {
        $query = '
            INSERT INTO `empresas`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $empresa->getName();
        $desc = $empresa->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetEmpresa((int) $this->database->lastInsertId());
    }

    public function updateEmpresa(Empresa $empresa): Empresa
    {
        $query = '
            UPDATE `empresas`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $empresa->getId();
        $name = $empresa->getName();
        $desc = $empresa->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetEmpresa((int) $id);
    }

    public function deleteEmpresa(int $empresaId): void
    {
        $query = 'DELETE FROM `empresas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $empresaId);
        $statement->execute();
    }
}
