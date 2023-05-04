<?php

namespace App\Controller;

use App\Infrastructure\Service\ProductServiceInterface;

class ProductController
{

    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function find($request)
    {
        return [
            'data' => $this->productService->find($request['param']),
            'status_code' => 200,
            'message' => ''
        ];
    }

    public function findAll()
    {
        return [
            'data' => $this->productService->findAll(),
            'status_code' => 200,
            'message' => ''
        ];
    }

    public function create($request)
    {
        $result = $this->productService->create($request['body']);

        if($result){
            $response = ['status_code' => 200, 'message' => 'Criado com sucesso'];
        } else {
            $response = ['status_code' => 500, 'message' => 'Erro ao tentar criar'];
        }

         return [
             'data' => [],
             'status_code' => $response['status_code'],
             'message' => $response['message']
         ];
    }


    public function update($request)
    {
        $result = $this->productService->update($request['param'],$request['body']);

        if($result){
            $response = ['status_code' => 200, 'message' => 'Atualizado com sucesso'];
        } else {
            $response = ['status_code' => 500, 'message' => 'Erro ao tentar atualizar'];
        }

         return [
             'data' => [],
             'status_code' => $response['status_code'],
             'message' => $response['message']
         ];
    }
}