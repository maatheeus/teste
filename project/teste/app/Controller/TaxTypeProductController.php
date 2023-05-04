<?php

namespace App\Controller;

use App\Infrastructure\Service\TaxTypeProductServiceInterface;

class TaxTypeProductController
{

    private TaxTypeProductServiceInterface $taxTypeProductService;

    public function __construct(TaxTypeProductServiceInterface $taxTypeProductService)
    {
        $this->taxTypeProductService = $taxTypeProductService;
    }

     public function find($request)
    {
        return [
            'data' => $this->taxTypeProductService->find($request['param']),
            'status_code' => 200,
            'message' => ''
        ];
    }

    public function findAll()
    {
        return [
            'data' => $this->taxTypeProductService->findAll(),
            'status_code' => 200,
            'message' => ''
        ];
    }

    public function create($request)
    {
        $result = $this->taxTypeProductService->create($request['body']);

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
        $result = $this->taxTypeProductService->update($request['param'],$request['body']);

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