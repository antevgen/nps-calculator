<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NpsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_resources(): void
    {
        $response = $this->getJson('/api/nps');

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->where('data.nps', 0)
        );
    }

    public function test_filled_resources(): void
    {
        $accounts = Account::factory()->count(4)->create();
        $promoters = Response::factory()
            ->withAccount()
            ->promoter()
            ->count(20)
            ->create();
        $detractors = Response::factory()
            ->withAccount()
            ->detractor()
            ->count(10)
            ->create();
        $passives = Response::factory()
            ->withAccount()
            ->passive()
            ->count(10)
            ->create();
        $response = $this->getJson('/api/nps');

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->where('data.nps', 25)
        );
    }
}
