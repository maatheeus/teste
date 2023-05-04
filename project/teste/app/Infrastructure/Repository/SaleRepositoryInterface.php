<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Database\DatabaseConnectionInterface;

interface SaleRepositoryInterface{
    public function __construct(DatabaseConnectionInterface $connection);
    public function findAll(): array;
    public function create(array $data): bool;
}