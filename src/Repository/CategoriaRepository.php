<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Categoria;

final class CategoriaRepository extends BaseRepository
{
    public function checkAndGetCategoria(int $categoriaId): Categoria
    {
        $query = 'SELECT * FROM `categorias` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $categoriaId);
        $statement->execute();
        $categoria = $statement->fetchObject(Categoria::class);
        if (! $categoria) {
            throw new \App\Exception\Categoria('Categoria not found.', 404);
        }

        return $categoria;
    }

    /**
     * @return array<string>
     */
    public function getCategorias(): array
    {
        $query = 'SELECT * FROM `categorias` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryCategoriasByPage(): string
    {
        return "
            SELECT *
            FROM `categorias`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getCategoriasByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryCategoriasByPage();
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

    public function createCategoria(Categoria $categoria): Categoria
    {
        $query = '
            INSERT INTO `categorias`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $categoria->getName();
        $desc = $categoria->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetCategoria((int) $this->database->lastInsertId());
    }

    public function updateCategoria(Categoria $categoria): Categoria
    {
        $query = '
            UPDATE `categorias`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $categoria->getId();
        $name = $categoria->getName();
        $desc = $categoria->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetCategoria((int) $id);
    }

    public function deleteCategoria(int $categoriaId): void
    {
        $query = 'DELETE FROM `categorias` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $categoriaId);
        $statement->execute();
    }
}
