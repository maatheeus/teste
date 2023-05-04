<?php

namespace App\Controller;

use App\Infrastructure\Service\SaleServiceInterface;

class SaleController
{

    private SaleServiceInterface $saleService;

    public function __construct(SaleServiceInterface $saleService)
    {
        $this->saleService = $saleService;
    }

    public function findAll()
    {
        return [
            'data' => $this->saleService->findAll(),
            'status_code' => 200,
            'message' => ''
        ];
    }

    public function create($request)
    {
        $result = $this->saleService->create($request['body']);

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


}