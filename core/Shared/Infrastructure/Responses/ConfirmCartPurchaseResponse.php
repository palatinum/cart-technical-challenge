<?php

namespace Core\Shared\Infrastructure\Responses;

use Core\Order\Domain\Entities\Order;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

readonly class ConfirmCartPurchaseResponse implements Responsable
{
    public function __construct(
        private Order $order
    ){}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                "cartId" => $this->order->cartId(),
                "quantity" => $this->order->quantity(),
            ],
        );
    }
}
