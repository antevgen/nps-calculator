<?php

namespace App\DTO;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ResponseListData extends Data
{
    public function __construct(
        public readonly Collection $data,
    ) {
    }
}
