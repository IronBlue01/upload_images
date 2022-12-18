<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;


class ProductController extends Controller
{
    public function __construct(
        protected readonly ProductService $productService,
    ) {
    }

    /**
     * Listar Produtos
     * 
     * Lista todos produtos cadastrados
     * @group Produtos
     */
    public function index()
    {
          return ProductResource::collection($this->productService->list());  
    }

    /**
     * Cadastrar Produto
     * 
     * Realiza o cadastro de um novo produto
     * @group Produtos
     */
    public function store(StoreProductRequest $request)
    {
        return ProductResource::make($this->productService->createNewProduct($request->validated(), $request->image));
    }

    /**
     * Detalhar Produto
     * 
     * Detalha os dados de um produto
     * @group Produtos
     */
    public function show(int $productId)
    {
        return ProductResource::make($this->productService->findById($productId));
    }

    /**
     * Atualizar Produto
     * 
     * Atualiza os dados de um produto
     * @group Produtos
     */
    public function update(UpdateProductRequest $request, int $productId)
    {
        return ProductResource::make($this->productService->updateProduct($request->validated(), $productId, $request->image));
    }

    /**
     * Remover  Produto
     * 
     * Deleta os dados de um produto
     * @group Produtos
     */
    public function destroy(int $productId)
    {   
        $this->productService->destroy($productId);
        return  response()->noContent();
    }
}
