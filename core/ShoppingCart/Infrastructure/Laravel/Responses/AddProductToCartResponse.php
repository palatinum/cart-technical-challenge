<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Responses;

use Core\ShoppingCart\Domain\Entities\CartProduct;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

readonly class AddProductToCartResponse implements Responsable
{
    public function __construct(
        private CartProduct $product
    ){}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                "id" => $this->product->id(),
                "cartId" => $this->product->cartId(),
                "productId" => $this->product->productId(),
                "quantity" => $this->product->quantity(),
            ],
            status: 200
        );
    }
}
