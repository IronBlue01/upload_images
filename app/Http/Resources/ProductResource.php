<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
         return [
            'id' => $this->getKey(),
            'nome' => $this->name,
            'descricao' => $this->description,
            'image' => url("storage/{$this->image}"),
            'criado_em' => Carbon::make($this->created_at)->format('d-m-Y')
        ];
       
    }
}
