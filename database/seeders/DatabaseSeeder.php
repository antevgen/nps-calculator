<?php

namespace Database\Seeders;

use Database\Factories\AccountFactory;
use Database\Factories\DriverFactory;
use Database\Factories\ResponseDriverFactory;
use Database\Factories\ResponseFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $accounts = AccountFactory::new()->count(4)->create();
        $drivers = DriverFactory::new()->count(5)->create();

        ResponseFactory::new()->for($accounts[0])->hasAttached($drivers)->create(['score' => 9]);
        ResponseFactory::new()->for($accounts[0])->hasAttached($drivers->take(2))->create(['score' => 4]);
        ResponseFactory::new()->for($accounts[0])->hasAttached($drivers)->create(['score' => 10]);
        ResponseFactory::new()->for($accounts[0])->hasAttached($drivers->take(1))->create(['score' => 8]);
        ResponseFactory::new()->for($accounts[1])->hasAttached($drivers->take(3))->create(['score' => 9]);
        ResponseFactory::new()->for($accounts[1])->hasAttached($drivers)->create(['score' => 10]);
        ResponseFactory::new()->for($accounts[1])->hasAttached($drivers->take(4))->create(['score' => 9]);
        ResponseFactory::new()->for($accounts[1])->hasAttached($drivers->take(1))->create(['score' => 2]);
        ResponseFactory::new()->for($accounts[2])->hasAttached($drivers)->create(['score' => 3]);
        ResponseFactory::new()->for($accounts[2])->hasAttached($drivers->take(2))->create(['score' => 5]);
        ResponseFactory::new()->for($accounts[2])->hasAttached($drivers->take(3))->create(['score' => 6]);
        ResponseFactory::new()->for($accounts[3])->hasAttached($drivers->take(1))->create(['score' => 9]);
        ResponseFactory::new()->for($accounts[3])->hasAttached($drivers)->create(['score' => 10]);
        ResponseFactory::new()->for($accounts[3])->create(['score' => 8]);
    }
}
