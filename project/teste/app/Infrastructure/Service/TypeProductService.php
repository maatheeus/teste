<?php

namespace App\Infrastructure\Service;
use App\Domain\TypeProduct;
use App\Infrastructure\Repository\TypeProductRepositoryInterface;

class TypeProductService implements TypeProductServiceInterface
{
    private $typeProductRepository;

    public function __construct(TypeProductRepositoryInterface $typeProductRepository)
    {
        $this->typeProductRepository = $typeProductRepository;
    }

    public function find(int $id): TypeProduct
    {
        return $this->typeProductRepository->find($id);
    }


    public function findAll(): array
    {
        return $this->typeProductRepository->findAll();
    }

    public function create(array $data): bool
    {
        return $this->typeProductRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
          return $this->typeProductRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
          return $this->typeProductRepository->delete($id);
    }
}