<?php

namespace App\Infrastructure\Service;
use App\Domain\Product;
use App\Domain\TaxTypeProduct;
use App\Infrastructure\Repository\TaxTypeProductRepository;

class TaxTypeProductService implements TaxTypeProductServiceInterface
{
    private $taxTypeProductRepository;

    public function __construct(TaxTypeProductRepository $taxTypeProductRepository)
    {
        $this->taxTypeProductRepository = $taxTypeProductRepository;
    }

    public function find(int $id): TaxTypeProduct
    {
        return $this->taxTypeProductRepository->find($id);
    }

    public function findAll(): array
    {
        return $this->taxTypeProductRepository->findAll();
    }

    public function create(array $data): bool
    {
        return $this->taxTypeProductRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
          return $this->taxTypeProductRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
          return $this->taxTypeProductRepository->delete($id);
    }

    public function calcTaxProduct(Product $product)
    {
        $descount = 0;
        $taxs = $this->taxTypeProductRepository->getTaxProduct($product->type_product_id);
        foreach($taxs as $tax){
            $descount += ($product->value * $tax->percentage) / 100;
        }

        return $descount;
    }
}