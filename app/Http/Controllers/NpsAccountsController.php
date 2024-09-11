<?php

namespace App\Http\Controllers;

use App\Actions\NpsAccountsCalculator;
use App\DTO\ResponseListData;

class NpsAccountsController extends Controller
{
    public function __invoke(NpsAccountsCalculator $npsAccountsCalculator)
    {
        return ResponseListData::from(['data' => $npsAccountsCalculator->execute()]);
    }
}
