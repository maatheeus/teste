<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Database\DatabaseConnectionInterface;

interface TypeProductRepositoryInterface{
    public function __construct(DatabaseConnectionInterface $connection);
    public function findAll(): array;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}