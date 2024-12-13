<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Responses;

use Core\ShoppingCart\Domain\Entities\Cart;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

readonly class CreateCartResponse implements Responsable
{
    public function __construct(
        private Cart $cart
    ){}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                "id" => $this->cart->id(),
                "quantity" => $this->cart->quantity(),
            ],
            status: 201
        );
    }
}
