<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Repository\TaxTypeProductRepository;

interface TaxTypeProductServiceInterface{
    public function __construct(TaxTypeProductRepository $taxTypeProductRepository);
    public function findAll(): array;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}