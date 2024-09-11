<?php

namespace App\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Data as SpatieData;
use Spatie\LaravelData\Lazy;

class ResponseData extends SpatieData
{
    public function __construct(
        public readonly ?SpatieData $data,
    ) {
    }
}
