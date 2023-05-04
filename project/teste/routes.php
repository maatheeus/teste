<?php

use App\Infrastructure\Libraries\Http\Json\HttpJsonRoute;
use App\Infrastructure\Database\PostgresConnection;
use App\Infrastructure\Repository\{TypeProductRepository, ProductRepositoy, TaxTypeProductRepository, SaleRepository};
use App\Infrastructure\Service\{TypeProductService, ProductService, TaxTypeProductService, SaleService};
use App\Controller\{TypeProductController, ProductController, TaxTypeProductController, SaleController};

$httpJsonRoute = new HttpJsonRoute();
$connection = PostgresConnection::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$typeProductRepository = new TypeProductRepository($connection);
$typeProduceService =  new TypeProductService($typeProductRepository);
$typeProductController = new TypeProductController($typeProduceService);

$productRepository = new ProductRepositoy($connection);
$productService =  new ProductService($productRepository);
$productController = new ProductController($productService);

$taxTypeProductRepository = new TaxTypeProductRepository($connection);
$taxTypeProductService =  new TaxTypeProductService($taxTypeProductRepository);
$taxTypeProductController = new TaxTypeProductController($taxTypeProductService);

$saleRepository = new SaleRepository($connection);
$saleService =  new SaleService($saleRepository, $productService, $taxTypeProductService);
$saleController = new SaleController($saleService);

$httpJsonRoute->post('/type-product/', [$typeProductController, 'create']);
$httpJsonRoute->get('/type-product/{param}/', [$typeProductController, 'find']);
$httpJsonRoute->put('/type-product/{param}/', [$typeProductController, 'update']);
$httpJsonRoute->get('/type-product/', [$typeProductController, 'findAll']);

$httpJsonRoute->post('/product/', [$productController, 'create']);
$httpJsonRoute->get('/product/{param}/', [$productController, 'find']);
$httpJsonRoute->put('/product/{param}/', [$productController, 'update']);
$httpJsonRoute->get('/product/', [$productController, 'findAll']);

$httpJsonRoute->post('/tax-type-product/', [$taxTypeProductController, 'create']);
$httpJsonRoute->get('/tax-type-product/{param}/', [$taxTypeProductController, 'find']);
$httpJsonRoute->put('/tax-type-product/{param}/', [$taxTypeProductController, 'update']);
$httpJsonRoute->get('/tax-type-product/', [$taxTypeProductController, 'findAll']);

$httpJsonRoute->post('/sale/', [$saleController, 'create']);

$httpJsonRoute->handleRequest();
?>