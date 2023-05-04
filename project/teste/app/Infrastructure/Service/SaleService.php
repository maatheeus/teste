<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Repository\SaleRepository;

class SaleService implements SaleServiceInterface {
    private SaleRepository $saleRepository;
    private ProductService $productService;
    private TaxTypeProductService $taxTypeProductService;

    public function __construct(SaleRepository $saleRepository,  ProductService $productService, TaxTypeProductService $taxTypeProductService){
        $this->saleRepository = $saleRepository;
        $this->productService = $productService;
        $this->taxTypeProductService = $taxTypeProductService;
    }
    public function findAll(): array
    {
        return [];
    }
    public function create(array $data): bool
    {
        $result = [];
        foreach ($data['products'] as $product)
        {
            $productDBO = $this->productService->find($product['product_id']);
            $tax = $this->taxTypeProductService->calcTaxProduct($productDBO);
            $taxValue = $tax ? $tax * $product['quantity'] : 0;
            $productValue = $productDBO->value * $product['quantity'];

            $result[] = [
                'productId' => $productDBO->id,
                'taxValue' => $taxValue,
                'quantity' => $product['quantity'],
                'valueWithTaxDiscount' => $productValue - $taxValue,
                'valueTotal' => $productValue
            ];
        }
        return $this->saleRepository->create($result);
    }
}