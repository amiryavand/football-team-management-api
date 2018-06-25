<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Team::class, 10)
            ->create()
            ->each(function ($t) {
                for ($i = 0; $i <= 10; $i++)
                    $t->players()->attach(factory(App\Player::class)->create());
            });
    }
}
