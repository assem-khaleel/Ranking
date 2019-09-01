<?php

use Illuminate\Database\Seeder;
use Seeds\SystemUsers;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             SystemUsers::class,
             RankingSystems::class,
             Criteria::class,
             Indicators::class,
             Institutions::class,
             Translator::class,
             College::class,
             Department::class,
             Program::class,
             Category::class
         ]);
    }
}
