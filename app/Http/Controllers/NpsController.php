<?php

namespace App\Http\Controllers;

use App\Actions\NpsCalculator;
use App\DTO\NpsData;
use App\DTO\ResponseData;

class NpsController extends Controller
{
    public function __invoke(NpsCalculator $npsCalculator)
    {
        $data = NpsData::fromNpsCalculator($npsCalculator->execute());
        return ResponseData::from(['data' => $data]);
    }
}
