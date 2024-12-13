<?php

namespace Tests\Feature\E2E;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCartControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGivenCorrectRequestShouldReturnSuccessResponse () {
        $response = $this->postJson("/api/v1/cart");
        $response->assertStatus(201)
            ->assertJson([
                "id" => 1,
                "quantity" => 0,
            ]);
    }
}
