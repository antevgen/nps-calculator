<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Data;

class NpsAccountsData extends Data
{
    public function __construct(
        public string $account,
        public int $nps,
    ) {
    }

    public static function fromNpsAccountCalculator(string $account, int $nps): self
    {
        return new self(
            $account,
            $nps
        );
    }
}
