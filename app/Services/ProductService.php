<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(
        protected readonly Product $repository,
    ) {
    }

    public function list()
    {
        return $this->repository->all();
    }

    public function createNewProduct(array $data, UploadedFile $image)
    {
        $path = $this->uploadImage($image);
        $data['image'] = $path;

        return $this->repository->create($data);
    }

    public function findById(int $productId)
    {
        return $this->repository->find($productId);
    }

    public function updateProduct(array $data, int $productId, UploadedFile $image = null)
    {
        $product = $this->findById($productId);

        if ($image) {
            if (Storage::exists($product->image))
                Storage::delete($product->image);

            $this->uploadImage($image);
        }

        $product->update($data);
        return $product;
    }

    public function destroy(int $productId)
    {   
        $product =  $this->findById($productId);

        if (Storage::exists($product->image))
                Storage::delete($product->image);
        
        $product->delete();
    }

    private function uploadImage(UploadedFile $image)
    {
        return $image->store('products');
    }
}