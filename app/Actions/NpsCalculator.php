<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Response;

class NpsCalculator
{
    public function execute(): int
    {
        $totalResponses = Response::count();
        $promoters = Response::where('score', '>', 8)->count();
        $detractors = Response::where('score', '<', 7)->count();

        if ($totalResponses) {
            $nps = (($promoters - $detractors) / $totalResponses) * 100;

            return (int) $nps;
        }

        return 0;
    }
}
