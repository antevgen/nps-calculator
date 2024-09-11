<?php

declare(strict_types=1);

use App\Models\Account;
use App\Models\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NpsAccountsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_resources(): void
    {
        $response = $this->getJson('/api/nps/accounts');

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data', 0)
        );
    }

    public function test_filled_resources(): void
    {
        $accounts = Account::factory()->count(4)->create();
        $scores = [
            [
                'promoter' => 5,
                'detractor' => 2,
                'passive' => 3,
            ],
            [
                'promoter' => 20,
                'detractor' => 10,
                'passive' => 10,
            ],
            [
                'promoter' => 10,
                'detractor' => 10,
                'passive' => 10,
            ],
            [
                'promoter' => 10,
                'detractor' => 20,
                'passive' => 10,
            ],
        ];
        $accounts->each(function (Account $account, int $key) use ($scores) {
            $promoters = Response::factory()
                ->withAccount($account->id)
                ->promoter()
                ->count($scores[$key]['promoter'])
                ->create();
            $detractors = Response::factory()
                ->withAccount($account->id)
                ->detractor()
                ->count($scores[$key]['detractor'])
                ->create();
            $passives = Response::factory()
                ->withAccount($account->id)
                ->passive()
                ->count($scores[$key]['passive'])
                ->create();
        });

        $response = $this->getJson('/api/nps/accounts');

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->has('data', 4)
                ->has('data.0',
                    fn ($json) =>
                    $json
                        ->where('account', $accounts[0]->name)
                        ->where('nps', 30)
                )
                ->has('data.1',
                    fn ($json) =>
                    $json
                        ->where('account', $accounts[1]->name)
                        ->where('nps', 25)
                )
                ->has('data.2',
                    fn ($json) =>
                    $json
                        ->where('account', $accounts[2]->name)
                        ->where('nps', 0)
                )
                ->has('data.3',
                    fn ($json) =>
                    $json
                        ->where('account', $accounts[3]->name)
                        ->where('nps', -25)
                )
        );
    }
}
