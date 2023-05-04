<?php

namespace App\Infrastructure\Service;
use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findAll(): array
    {
        return $this->productRepository->findAll();
    }

    public function create(array $data): bool
    {
        return $this->productRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
          return $this->productRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
          return $this->productRepository->delete($id);
    }

    public function find(int $id): Product
    {
        return $this->productRepository->find($id);
    }
}