<?php

namespace App\Controller;

use App\Infrastructure\Service\TypeProductServiceInterface;

class TypeProductController
{

    private TypeProductServiceInterface $typeProductService;

    public function __construct(TypeProductServiceInterface $typeProductService)
    {
        $this->typeProductService = $typeProductService;
    }

    public function find($request)
    {
        return [
            'data' => $this->typeProductService->find($request['param']),
            'status_code' => 200,
            'message' => ''
        ];
    }

    public function findAll()
    {
        return [
            'data' => $this->typeProductService->findAll(),
            'status_code' => 200,
            'message' => ''
        ];
    }

    public function create($request)
    {
        $result = $this->typeProductService->create($request['body']);

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
        $result = $this->typeProductService->update($request['param'],$request['body']);

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