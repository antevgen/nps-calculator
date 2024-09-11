<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Data;

class NpsData extends Data
{
    public function __construct(
        public int $nps,
    ) {
    }

    public static function fromNpsCalculator(int $score): self
    {
        return new self(
            $score
        );
    }
}
