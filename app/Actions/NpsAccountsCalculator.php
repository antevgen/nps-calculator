<?php

namespace App\Actions;

use App\DTO\NpsAccountsData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NpsAccountsCalculator
{
    public function execute(): Collection
    {
        $npsByAccounts = DB::table('responses')
            ->selectRaw(
                '(((SUM(IF(score > 8, 1, 0)) - SUM(IF(score < 7, 1, 0))) / COUNT(*)) * 100) as score'
            )
            ->selectRaw(
                'accounts.name as accountName'
            )
            ->join('accounts', 'responses.account_id', '=', 'accounts.id')
            ->groupBy('account_id')
            ->get();

        $npsByAccountsCollection = $npsByAccounts->map(function ($npsByAccount) {
            return NpsAccountsData::fromNpsAccountCalculator($npsByAccount->accountName, $npsByAccount->score);
        });

        return NpsAccountsData::collect($npsByAccountsCollection);
    }
}
