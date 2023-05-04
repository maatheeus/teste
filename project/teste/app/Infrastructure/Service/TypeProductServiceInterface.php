<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Repository\TypeProductRepositoryInterface;

interface TypeProductServiceInterface{
    public function __construct(TypeProductRepositoryInterface $typeProductRepository);
    public function findAll(): array;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}