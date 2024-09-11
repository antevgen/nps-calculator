<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseFactory extends Factory
{
    protected $model = Response::class;

    public function definition(): array
    {
        return [
            'score' => $this->faker->numberBetween(0, 10),
            'account_id' => AccountFactory::new()->lazy(),
        ];
    }

    public function withAccount(?int $accountId = null): self
    {
        return $this->state(function (array $attributes) use ($accountId) {
            return [
                'account_id' => $accountId ?? Account::get()->random()->id,
            ];
        });
    }

    public function promoter(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'score' => $this->faker->numberBetween(9, 10),
            ];
        });
    }

    public function passive(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'score' => $this->faker->numberBetween(7, 8),
            ];
        });
    }

    public function detractor(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'score' => $this->faker->numberBetween(0, 6),
            ];
        });
    }
}
