<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Repository\ProductRepositoryInterface;

interface ProductServiceInterface{
    public function __construct(ProductRepositoryInterface $productRepository);
    public function findAll(): array;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}