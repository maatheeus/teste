<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Repository\SaleRepository;

interface SaleServiceInterface{
    public function __construct(SaleRepository $saleRepository, ProductService $productService, TaxTypeProductService $taxTypeProductService);
    public function findAll(): array;
    public function create(array $data): bool;
}