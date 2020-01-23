<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Seed the application's database.
    public function run() {
        $this->call([
            UsersQuestionsAnswersTableSeeder::class,;
            FavouritesTableSeeder::class,
            VotablesTableSeeder::class,
        ]);
    }
}
